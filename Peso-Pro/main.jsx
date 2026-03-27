
import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App";
import "./index.css";

// Registra Chart.js automáticamente (evita plugins omitidos)
import "chart.js/auto";

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
