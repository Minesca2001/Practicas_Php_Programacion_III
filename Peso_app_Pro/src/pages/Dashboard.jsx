
import { useEffect, useState } from "react";
import { obtenerPesos } from "../services/pesoService";
import { Line } from "react-chartjs-2";

export default function Dashboard(){
  const [data, setData] = useState([]);

  useEffect(()=>{
    cargar();
  },[]);

  const cargar = async ()=>{
    const d = await obtenerPesos();
    setData(d);
  };

  return (
    <div>
      <h1>Dashboard</h1>
      <Line data={{
        labels: data.map(d=>d.fecha),
        datasets:[{label:"Peso", data:data.map(d=>d.peso)}]
      }}/>
    </div>
  );
}
