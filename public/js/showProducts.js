// Con una asiganación a una variable de la función queryselector se crea una versión reducida del selector y se
// se recogen todos los elementos que interesan del dom

const select = (e) => document.querySelector(e);

const btnOrders = select("#order-btn");
const btnActivity = select("#activity-btn");
const btnProduct = select("#product-btn");
const toDollar = select("#convert-to-dollar");
const toEuro = select("#convert-to-euro");
const btnToggle = select("#accordionFlushExample");
const priceFilter = select("#filter-price");
const tHead = select("thead");
const tBody = select("tbody");
const filters = select("#filters");
const userBtn = select("#user-btn");
const dateFrom = select(".date-from");
const dateUntil = select(".date-until");
const table = select("table");
const orderFilters = select("#order-filter");

// Array que almacenará los logs cargados de la api
let allLogs = [];

// Inicia la tabla de logs al hacer click en el botón de Actividad
btnProduct.addEventListener("click", initTable);

// Función que prepara todos los elementos HTML para mostrar los logs
function setActivityElements() {
  btnOrders.classList.remove("snd-btn-selected");
  btnActivity.classList.remove("snd-btn-selected");
  btnProduct.classList.add("snd-btn-selected");
  userBtn.classList.remove("snd-btn-selected");
  toDollar.removeAttribute("hidden");
  toEuro.removeAttribute("hidden");
  toDollar.setAttribute("hidden", true);
  toEuro.setAttribute("hidden", true);
  btnToggle.setAttribute("hidden", true);
  priceFilter.setAttribute("hidden", true);
  filters.setAttribute("hidden", true);
  orderFilters.setAttribute("hidden", true);

  table.classList.add("mt-5");
}

// Llamada a la API que carga los logs
async function initTable() {
  setActivityElements();
  const API_URL = "?controller=api&action=showProducts";
  const response = await fetch(API_URL);
  const data = await response.json();
  console.log(data);
  if (!response.ok) {
    table.innerHTML = "No hay registros por mostrar";
    table.innerHTML = "<p>No hay registro de actividad por mostrar</p>";
  } else {
    allLogs = data.data;
    createHTMLTable(data.data);
  }
}

// Función que crea la tabla
function createHTMLTable(data) {
  tBody.innerHTML = "";
  tHead.innerHTML = "";
  const headersLogs = [
    "PRODUCTO ID",
    "NOMBRE PRODUCTO",
    "FOTOGRAFÍA",
    "CATEGORÍA",
    "PRECIO",
  ];

  const tr = document.createElement("tr");
  for (const header of headersLogs) {
    const th = document.createElement("th");
    th.innerText = header;
    tr.append(th);
    th.classList.add("text-center");
    th.classList.add("align-top");
  }
  tHead.append(tr);

  for (const obj of data) {
    const tr = document.createElement("tr");

    tr.innerHTML = `
  <td class="text-center border-table">${obj.product_id ?? "-"}</td>
       <td class="text-center border-table">${obj.product_name ?? "-"}</td>
 <td class="text-center border-table">${obj.main_photo ?? "-"}</td>
  <td class="text-center border-table">${obj.category_id ?? "-"}</td>
   <td class="text-center border-table">${
     obj.base_price ?? "-"
   }€</td><td class="text-center border-table">
 <button data-id="${
   obj.product_id
 }" class="remove-order-button order-button"><i class="fa-solid fa-trash"></i></button></td>
  `;
    tBody.append(tr);
  }
  const removeButtons = document.querySelectorAll(".remove-order-button");
  for (const button of removeButtons) {
    button.addEventListener("click", (e) => {
      const buttonSelected = e.target.closest(".remove-order-button");
      const id = buttonSelected.getAttribute("data-id");
      removeProduct(id);
    });
  }
}

async function removeProduct(id) {
  const API_URL = "?controller=api&action=deleteProduct";
  const question = confirm(
    `¿Estás seguro que quieres ELIMINAR el producto con ID ${id}?`
  );
  if (question) {
    const response = await fetch(API_URL, {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(id),
    });

    if (response.ok) {
      alert("Producto el eliminado con éxito");
      document.querySelector(`button[data-id="${id}"]`).closest("tr").remove();
    } else {
      alert("No se pudo eliminar el producto.");
    }
  }
}
