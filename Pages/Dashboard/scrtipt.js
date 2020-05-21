$(document).ready(function () {
  $("#TabelaContas").DataTable();
});

const d = new Date();
const data = `${String(new Date().toISOString().slice(0, 10))}`;
console.log(data);

$("#DataFinal").value = data;
