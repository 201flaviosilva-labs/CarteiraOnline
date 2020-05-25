$(document).ready(function () {
  $("#TabelaContas").DataTable();
});

const d = new Date();
document.getElementById("DataRegistro").value = `${String(
  new Date().toISOString().slice(0, 10)
)}`;
