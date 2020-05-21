$(document).ready(function () {
  $("#TabelaContas").DataTable();
});

const d = new Date();
const data = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(
  2,
  "0"
)}-${d.getDate()}`;
console.log(data);

$("#DataFinal").value = data;
