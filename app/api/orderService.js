const API_URL = "http://localhost/drburger.com/app/api/api.php";

async function getOrders() {
  const filterValue = document.getElementById("filter").value;
  const response = await fetch(API_URL + "?filter=" + filterValue);
  const data = await response.json();
  console.log(data);
  alert("Pedidos cargados");
}

document.getElementById("filter").addEventListener("change", getOrders);
