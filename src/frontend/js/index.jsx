import React, { Fragment } from "react";
import ReactDOM from "react-dom/client";
import App from "./App";
import {currentUser, workers} from "./components/Workers";
import WorkerDashboard from "./components/WorkerDashboard";
import Filter from "./components/Filter";


if (document.getElementById("worker_filter") != null) {
  const root = ReactDOM.createRoot(document.getElementById("worker_filter"));
  root.render(
    <div className="bg-white rounded-lg p-3">
      <Filter />
    </div>
  );
}else if (document.getElementById("ac_worker_account_calendar") != null) {
  const root = ReactDOM.createRoot(document.getElementById("ac_worker_account_calendar"));
  root.render(
    <App />
  );
}else if (document.getElementById("ac_worker_manager_account_dashboard") != null) {
  const root = ReactDOM.createRoot(document.getElementById("ac_worker_manager_account_dashboard"));
  root.render(
    <WorkerDashboard />
  );
}
