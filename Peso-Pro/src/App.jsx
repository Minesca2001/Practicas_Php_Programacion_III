import { useEffect, useMemo, useRef, useState } from "react";
// Firebase
import { initializeApp } from "firebase/app";
import {
  getAuth,
  signInWithEmailAndPassword,
  createUserWithEmailAndPassword,
  onAuthStateChanged,
  signOut,
} from "firebase/auth";
import {
  getFirestore,
  collection,
  addDoc,
  deleteDoc,
  doc,
  setDoc,
  getDoc,
  onSnapshot,
  serverTimestamp,
  query,
  orderBy,
} from "firebase/firestore";
// Chart
import { Line } from "react-chartjs-2";
// Export
import * as XLSX from "xlsx";
import jsPDF from "jspdf";
import html2canvas from "html2canvas";

/**
 * 🔐 Firebase config — usa variables de entorno (.env) en Vite
 * Crea un archivo .env con:
 *  VITE_FIREBASE_API_KEY=...
 *  VITE_FIREBASE_AUTH_DOMAIN=...
 *  VITE_FIREBASE_PROJECT_ID=...
 *  VITE_FIREBASE_STORAGE_BUCKET=...
 *  VITE_FIREBASE_MESSAGING_SENDER_ID=...
 *  VITE_FIREBASE_APP_ID=...
 *  VITE_FIREBASE_MEASUREMENT_ID=...
 */
const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
  projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
  storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
  messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
  appId: import.meta.env.VITE_FIREBASE_APP_ID,
  measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID,
};

// Inicializa Firebase fuera del componente para evitar re-inicializaciones
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

export default function App() {
  // Estado
  const [user, setUser] = useState(null);
  const [rol, setRol] = useState("user");
  const [email, setEmail] = useState("");
  const [pass, setPass] = useState("");
  const [datos, setDatos] = useState([]);
  const [filtro, setFiltro] = useState("");
  const [form, setForm] = useState({ nombre: "", peso: "", fecha: "" });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  // Refs
  const exportRef = useRef(null);

  // Colecciones
  const pesosRef = collection(db, "pesos");

  // Helpers
  const toNumber = (v) => {
    const n = typeof v === "number" ? v : parseFloat(String(v).replace(",", "."));
    return Number.isFinite(n) ? n : 0;
  };

  const isFormValid = useMemo(() => {
    const nombreOk = form.nombre.trim().length > 0;
    const pesoOk = toNumber(form.peso) > 0;
    const fechaOk = Boolean(form.fecha);
    return nombreOk && pesoOk && fechaOk;
  }, [form]);

  // Cargar rol del usuario
  const cargarRol = async (uid) => {
    try {
      const snap = await getDoc(doc(db, "users", uid));
      if (snap.exists()) {
        const data = snap.data();
        setRol(data?.rol || "user");
      } else {
        setRol("user");
      }
    } catch (e) {
      console.error(e);
      setRol("user");
    }
  };

  // Suscripción a auth y datos
  useEffect(() => {
    const unsubscribeAuth = onAuthStateChanged(auth, async (u) => {
      setUser(u);
      if (u) {
        await cargarRol(u.uid);
      } else {
        setDatos([]);
        setRol("user");
      }
    });

    // Suscripción en tiempo real a los pesos
    const q = query(pesosRef, orderBy("fecha", "asc"));
    const unsubscribeData = onSnapshot(
      q,
      (snapshot) => {
        const rows = snapshot.docs.map((d) => ({ id: d.id, ...d.data() }));
        setDatos(rows);
      },
      (err) => {
        console.error(err);
        setError("No se pudieron cargar los datos");
      }
    );

    return () => {
      unsubscribeAuth();
      unsubscribeData();
    };
  }, [pesosRef]);

  // Auth
  const register = async () => {
    setError("");
    setLoading(true);
    try {
      const cred = await createUserWithEmailAndPassword(auth, email, pass);
      await setDoc(doc(db, "users", cred.user.uid), {
        email,
        rol: "user",
        createdAt: serverTimestamp(),
      });
    } catch (e) {
      console.error(e);
      setError(e.message || "Error al registrar");
    } finally {
      setLoading(false);
    }
  };

  const login = async () => {
    setError("");
    setLoading(true);
    try {
      await signInWithEmailAndPassword(auth, email, pass);
    } catch (e) {
      console.error(e);
      setError(e.message || "Error al iniciar sesión");
    } finally {
      setLoading(false);
    }
  };

  const logout = async () => {
    try {
      await signOut(auth);
    } catch (e) {
      console.error(e);
    }
  };

  // CRUD
  const guardar = async () => {
    if (!isFormValid) return;
    setLoading(true);
    setError("");
    try {
      await addDoc(pesosRef, {
        nombre: form.nombre.trim(),
        peso: toNumber(form.peso),
        fecha: form.fecha, // ISO string yyyy-mm-dd
        createdAt: serverTimestamp(),
      });
      setForm({ nombre: "", peso: "", fecha: "" });
    } catch (e) {
      console.error(e);
      setError("No se pudo guardar el registro");
    } finally {
      setLoading(false);
    }
  };

  const eliminar = async (id) => {
    if (rol !== "admin") return; // Guard clause de seguridad en UI
    try {
      await deleteDoc(doc(db, "pesos", id));
    } catch (e) {
      console.error(e);
      setError("No se pudo eliminar el registro");
    }
  };

  // Filtro
  const nombres = useMemo(
    () => Array.from(new Set(datos.map((d) => d.nombre))).sort((a, b) => a.localeCompare(b)),
    [datos]
  );
  const datosFiltrados = useMemo(
    () => (filtro ? datos.filter((d) => d.nombre === filtro) : datos),
    [datos, filtro]
  );

  // Métricas robustas
  const pesos = useMemo(() => datosFiltrados.map((d) => toNumber(d.peso)), [datosFiltrados]);
  const promedio = pesos.length ? pesos.reduce((a, b) => a + b, 0) / pesos.length : 0;
  const max = pesos.length ? Math.max(...pesos) : 0;
  const min = pesos.length ? Math.min(...pesos) : 0;

  // Export
  const exportExcel = () => {
    const ws = XLSX.utils.json_to_sheet(
      datosFiltrados.map((d) => ({
        Nombre: d.nombre,
        Peso: toNumber(d.peso),
        Fecha: d.fecha,
      }))
    );
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Pesos");
    XLSX.writeFile(wb, "pesos.xlsx");
  };

  const exportPDF = async () => {
    const el = exportRef.current || document.body;
    const canvas = await html2canvas(el);
    const img = canvas.toDataURL("image/png");
    const pdf = new jsPDF({ orientation: "landscape", unit: "px", format: "a4" });
    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();
    const ratio = Math.min(pageWidth / canvas.width, pageHeight / canvas.height);
    const imgWidth = canvas.width * ratio;
    const imgHeight = canvas.height * ratio;
    pdf.addImage(img, "PNG", (pageWidth - imgWidth) / 2, 20, imgWidth, imgHeight);
    pdf.save("reporte_pesos.pdf");
  };

  const exportIMG = async () => {
    const el = exportRef.current || document.body;
    const canvas = await html2canvas(el);
    const link = document.createElement("a");
    link.download = "reporte_pesos.png";
    link.href = canvas.toDataURL("image/png");
    link.click();
  };

  // Chart data
  const chartData = useMemo(
    () => ({
      labels: datosFiltrados.map((d) => d.fecha),
      datasets: [
        {
          label: "Peso",
          data: pesos,
          borderColor: "#2563eb",
          backgroundColor: "rgba(37, 99, 235, 0.15)",
          tension: 0.25,
          pointRadius: 3,
        },
      ],
    }),
    [datosFiltrados, pesos]
  );

  const chartOptions = useMemo(
    () => ({
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: true },
        tooltip: { intersect: false, mode: "index" },
      },
      scales: {
        y: { beginAtZero: true },
      },
    }),
    []
  );

  // UI
  if (!user) {
    return (
      <div style={{ maxWidth: 420, margin: "80px auto", textAlign: "center" }}>
        <h2>Peso App PRO</h2>
        <input
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          style={{ width: "100%", padding: 8, marginBottom: 8 }}
        />
        <input
          type="password"
          placeholder="Password"
          value={pass}
          onChange={(e) => setPass(e.target.value)}
          style={{ width: "100%", padding: 8, marginBottom: 12 }}
        />
        {error && (
          <p style={{ color: "#b91c1c", marginBottom: 8 }}>{error}</p>
        )}
        <div style={{ display: "flex", gap: 8, justifyContent: "center" }}>
          <button onClick={login} disabled={loading}>
            {loading ? "Entrando…" : "Login"}
          </button>
          <button onClick={register} disabled={loading}>
            {loading ? "Creando…" : "Register"}
          </button>
        </div>
      </div>
    );
  }

  return (
    <div style={{ padding: 20 }}>
      <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center" }}>
        <h2>Dashboard ({rol})</h2>
        <div>
          <span style={{ marginRight: 12 }}>{user.email}</span>
          <button onClick={logout}>Salir</button>
        </div>
      </div>

      <div
        ref={exportRef}
        style={{
          display: "grid",
          gridTemplateColumns: "repeat(auto-fit, minmax(240px, 1fr))",
          gap: 12,
          alignItems: "start",
        }}
      >
        <div style={{ border: "1px solid #e5e7eb", borderRadius: 8, padding: 12 }}>
          <h3>Nuevo registro</h3>
          <input
            placeholder="Nombre"
            value={form.nombre}
            onChange={(e) => setForm({ ...form, nombre: e.target.value })}
            style={{ width: "100%", padding: 8, marginBottom: 8 }}
          />
          <input
            placeholder="Peso"
            value={form.peso}
            onChange={(e) => setForm({ ...form, peso: e.target.value })}
            style={{ width: "100%", padding: 8, marginBottom: 8 }}
          />
          <input
            type="date"
            value={form.fecha}
            onChange={(e) => setForm({ ...form, fecha: e.target.value })}
            style={{ width: "100%", padding: 8, marginBottom: 8 }}
          />
          <button onClick={guardar} disabled={!isFormValid || loading}>
            {loading ? "Guardando…" : "Guardar"}
          </button>
          {!isFormValid && (
            <p style={{ color: "#b45309", marginTop: 8 }}>
              Completa nombre, peso (&gt; 0) y fecha.
            </p>
          )}
        </div>

        <div style={{ border: "1px solid #e5e7eb", borderRadius: 8, padding: 12 }}>
          <h3>Filtro</h3>
          <select
            value={filtro}
            onChange={(e) => setFiltro(e.target.value)}
            style={{ width: "100%", padding: 8 }}
          >
            <option value="">Todos</option>
            {nombres.map((n) => (
              <option key={n} value={n}>
                {n}
              </option>
            ))}
          </select>

          <div style={{ display: "flex", gap: 12, marginTop: 12, flexWrap: "wrap" }}>
            <button onClick={exportExcel}>Exportar Excel</button>
            <button onClick={exportPDF}>Exportar PDF</button>
            <button onClick={exportIMG}>Exportar IMG</button>
          </div>

          <div style={{ display: "grid", gridTemplateColumns: "repeat(3, 1fr)", gap: 8, marginTop: 12 }}>
            <div style={{ background: "#f1f5f9", padding: 8, borderRadius: 6 }}>Promedio: {promedio.toFixed(2)}</div>
            <div style={{ background: "#f1f5f9", padding: 8, borderRadius: 6 }}>Máximo: {max}</div>
            <div style={{ background: "#f1f5f9", padding: 8, borderRadius: 6 }}>Mínimo: {min}</div>
          </div>
        </div>

        <div style={{ gridColumn: "1 / -1", border: "1px solid #e5e7eb", borderRadius: 8, padding: 12 }}>
          <h3>Registros</h3>
          <div style={{ overflowX: "auto" }}>
            <table style={{ width: "100%", borderCollapse: "collapse" }}>
              <thead>
                <tr>
                  <th style={{ textAlign: "left", borderBottom: "1px solid #e5e7eb", padding: 8 }}>Nombre</th>
                  <th style={{ textAlign: "left", borderBottom: "1px solid #e5e7eb", padding: 8 }}>Peso</th>
                  <th style={{ textAlign: "left", borderBottom: "1px solid #e5e7eb", padding: 8 }}>Fecha</th>
                  <th style={{ textAlign: "left", borderBottom: "1px solid #e5e7eb", padding: 8 }}>Acciones</th>
                </tr>
              </thead>
              <tbody>
                {datosFiltrados.map((d) => (
                  <tr key={d.id}>
                    <td style={{ borderBottom: "1px solid #f1f5f9", padding: 8 }}>{d.nombre}</td>
                    <td style={{ borderBottom: "1px solid #f1f5f9", padding: 8 }}>{toNumber(d.peso)}</td>
                    <td style={{ borderBottom: "1px solid #f1f5f9", padding: 8 }}>{d.fecha}</td>
                    <td style={{ borderBottom: "1px solid #f1f5f9", padding: 8 }}>
                      {rol === "admin" && (
                        <button onClick={() => eliminar(d.id)}>Eliminar</button>
                      )}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>

        <div style={{ gridColumn: "1 / -1", height: 320, border: "1px solid #e5e7eb", borderRadius: 8, padding: 12 }}>
          <Line data={chartData} options={chartOptions} />
        </div>
      </div>
    </div >
  );
}