const select = (e) => document.querySelector(e);

const btnOrders = select("#order-btn");
const btnActivity = select("#activity-btn");
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

let allLogs = [];

btnActivity.addEventListener("click", initTable);

function setActivityElements() {
  btnOrders.classList.remove("snd-btn-selected");
  btnActivity.classList.add("snd-btn-selected");
  userBtn.classList.remove("snd-btn-selected");
  toDollar.removeAttribute("hidden");
  toEuro.removeAttribute("hidden");
  toDollar.setAttribute("hidden", true);
  toEuro.setAttribute("hidden", true);
  btnToggle.setAttribute("hidden", true);
  priceFilter.setAttribute("hidden", true);
  filters.setAttribute("hidden", true);
  orderFilters.setAttribute("hidden", true);
  //   filters.classList.add("mt-5");
  table.classList.add("mt-5");
}

async function initTable() {
  setActivityElements();
  const API_URL = "?controller=api&action=showLogs";
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

function createHTMLTable(data) {
  tBody.innerHTML = "";
  tHead.innerHTML = "";
  const headersLogs = [
    "LOG ID",
    "USUARIO",
    "ACCION",
    "TABLA",
    "ID AFECTADO",
    "FECHA",
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
  <td class="text-center border-table">${obj.log_id ?? "-"}</td>
       <td class="text-center border-table">${obj.user_id ?? "-"}</td>
 <td class="text-center border-table">${obj.action ?? "-"}</td>
  <td class="text-center border-table">${obj.altered_table ?? "-"}</td>
   <td class="text-center border-table">${obj.object_id ?? "-"}</td>
    <td class="text-center border-table">${obj.date_time ?? "-"}</td>


  `;
    tBody.append(tr);
  }
}

// let dateFromFilter;
// let dateUntilFilter;

// function applyDateFilters() {
//   let filteredOrders = ;

//   if (dateFromFilter) {
//     filteredOrders = filteredOrders.filter(
//       (order) => new Date(order.dateTime) >= dateFromFilter
//     );
//   }

//   if (dateUntilFilter) {
//     filteredOrders = filteredOrders.filter(
//       (order) => new Date(order.dateTime) <= dateUntilFilter
//     );
//   }

//   createHTMLTable(filteredOrders);
// }

// dateFrom.addEventListener("input", (e) => {
//   e.preventDefault();
//   let dateFilter = e.target.value;

//   dateFromFilter = dateFilter ? new Date(dateFilter) : null;
//   if (dateFromFilter) {
//     dateFromFilter.setHours(0, 0, 0);
//   }

//   applyDateFilters();
// });

// dateUntil.addEventListener("input", (e) => {
//   e.preventDefault();
//   let dateFilter = e.target.value;

//   dateUntilFilter = dateFilter ? new Date(dateFilter) : null;
//   if (dateUntilFilter) {
//     dateUntilFilter.setHours(23, 59, 59);
//   }

//   applyDateFilters();
// });
