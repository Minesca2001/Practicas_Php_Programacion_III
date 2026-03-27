
import { useState } from "react";
import { login } from "../services/auth";
import { useNavigate } from "react-router-dom";

export default function Login(){
  const [email, setEmail] = useState("");
  const [pass, setPass] = useState("");
  const nav = useNavigate();

  const handle = async () => {
    await login(email, pass);
    if(email === "admin@gmail.com") nav("/admin");
    else nav("/dashboard");
  };

  return (
    <div className="flex flex-col items-center justify-center h-screen">
      <input placeholder="Email" onChange={e=>setEmail(e.target.value)} />
      <input type="password" placeholder="Password" onChange={e=>setPass(e.target.value)} />
      <button onClick={handle}>Login</button>
    </div>
  );
}
