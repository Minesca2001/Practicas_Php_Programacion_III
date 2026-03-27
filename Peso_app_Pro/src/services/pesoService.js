
import { db } from "../firebase";
import { collection, getDocs } from "firebase/firestore";

export const obtenerPesos = async ()=>{
  const snap = await getDocs(collection(db, "pesos"));
  return snap.docs.map(d=>({id:d.id, ...d.data()}));
};
