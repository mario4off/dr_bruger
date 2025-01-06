import { User } from "/drburger.com/public/js/models/User.js";

const select = (e) => document.querySelector(e);
const tHead = select("thead");
const tBody = select("tbody");
const userFilter = select("#user-filter");
const dateFrom = select(".date-from");
const btnToggle = select("#accordionFlushExample");
const dateUntil = select(".date-until");
const btnActivity = select("#activity-btn");
const priceFrom = select(".price-from");
const priceFilter = select("#filter-price");
const priceUntil = select(".price-until");
const table = select("table");
const filters = select("#filters");
const toDollar = select("#convert-to-dollar");
const toEuro = select("#convert-to-euro");
const orderBtn = select("#order-btn");
const userBtn = select("#user-btn");
const productBtn = select("#product-btn");
const activityBtn = select("#activity-btn");
const inputUser = select("#input-user");
const inputPayment = select("#input-payment");
const inputNum = select("#input-card");
const inputAllergies = select("#input-allergies");
const inputPrice = select("#input-total-price");
const inputDelivery = select("#input-delivery");
const btnInsert = select("#btn-insert");
const textInsert = select("#text-insert");

userBtn.addEventListener("click", () => {
  setUserElements();
  initTable();
});

btnInsert.addEventListener("click", (e) => {
  e.preventDefault();
  insertOrder();
});

// const orderSelect = document.getElementById("select-order");

let allUsers = [];

async function initTable() {
  const API_URL = "?controller=api&action=showUsers";
  const response = await fetch(API_URL);
  const data = await response.json();
  console.log(data);
  allUsers.splice(0, allUsers.length);
  if (!response.ok) {
    table.innerHTML = "";
    table.innerHTML = "<p>No hay usuarios por mostrar</p>";
  } else {
    for (const el of data.data) {
      allUsers.push(
        new User(
          el.user_id,
          el.name,
          el.last_name,
          el.address,
          el.mail,
          el.phone,
          el.role,
          "Informatica_1",
          el.city,
          el.cp
        )
      );
    }

    console.log(allUsers);

    createHTMLTable(allUsers);

    tBody.addEventListener("click", (e) => {
      const cell = e.target;

      if (cell.cellIndex == 6) {
        const currenValue = cell.innerText;
        const row = cell.parentElement;

        cell.innerHTML = `<select class="mod" value="${currenValue}"><option>Selecciona rol</option>
      <option>customer</option><option>admin</option></select>`;
        addConfirmButton(row);

        const input = cell.querySelector(".mod");
        input.focus();

        input.addEventListener("blur", () => {
          const updateValue = input.value;

          cell.innerHTML = updateValue;
          const userId = cell.parentElement.querySelector("td").innerHTML;

          allUsers = allUsers.map((e) => {
            if (e.userId == userId) {
              e.role = updateValue;
            }
            return e;
          });
        });
      }
    });
  }
}

function createHTMLTable(data) {
  tBody.innerHTML = "";
  tHead.innerHTML = "";
  const headersUsers = [
    "USUARIO",
    "NOMBRE",
    "APELLIDOS",
    "DIRECCIÓN",
    "MAIL",
    "TELÉFONO",
    "ROL",
    "CIUDAD",
    "CP",
  ];
  const tr = document.createElement("tr");
  for (const header of headersUsers) {
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
    <td class="text-center border-table">${obj.userId ?? "-"}</td>
    <td class="text-center border-table">${obj.name ?? "-"}</td>
        <td class="text-center border-table">${obj.lastName ?? "-"}</td>
    <td class="text-center border-table">${obj.address ?? "-"}</td>
<td class="text-center border-table">${obj.mail ?? "-"}</td>
<td class="text-center border-table">${obj.phone ?? "-"}</td>
    <td class="text-center border-table edit-td">${
      obj.role ?? "-"
    } <i class="fa-solid fa-pencil align-self-end"></i></td>
    
    <td class="text-center border-table">${obj.city ?? "-"}</td>
    <td class="text-center border-table">${obj.cp ?? "-"}</td>
    <td class="text-center border-table"><div class="d-flex gap-3"><button data-id="${
      obj.userId
    }" class="update-order-button order-button" hidden><i class="fa-solid fa-check"></i></button><button data-id="${
      obj.userId
    }" class="remove-order-button order-button"><i class="fa-solid fa-trash"></i></button></div></td>
    `;
    tBody.append(tr);
  }

  const updateButtons = document.querySelectorAll(".update-order-button");
  const removeButtons = document.querySelectorAll(".remove-order-button");

  for (const button of updateButtons) {
    button.addEventListener("click", (e) => {
      const buttonSelected = e.target.closest(".update-order-button");
      buttonSelected.setAttribute("hidden", true);
      const id = buttonSelected.getAttribute("data-id");
      console.log(allUsers);
      const user = allUsers.find((user) => user.userId == id);

      updateUser(user);
    });
  }

  for (const button of removeButtons) {
    button.addEventListener("click", (e) => {
      const buttonSelected = e.target.closest(".remove-order-button");
      const id = buttonSelected.getAttribute("data-id");
      removeUser(id);
    });
  }
}

async function removeUser(id) {
  const API_URL = "?controller=api&action=deleteUser";
  const question = confirm(
    `¿Estás seguro que quieres ELIMINAR al usuario con ID ${id}?`
  );
  if (question) {
    const response = await fetch(API_URL, {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(id),
    });

    if (response.ok) {
      alert("Usuario eliminado con éxito");
      document.querySelector(`button[data-id="${id}"]`).closest("tr").remove();
    } else {
      alert("No se pudo eliminar al usuario.");
    }
  }
}

async function insertUser() {
  const API_URL = "?controller=api&action=createUser";

  const response = await fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      userId: inputUser.value,
      status: "En preparación",
      paymentMethod: inputPayment.value,
      cardNumber: inputNum.value ?? " ",
      promotionId: null,
      totalAmount: inputPrice.value ?? 0.0,
      deliveryCost: inputDelivery.value ?? 0.0,
      iva: inputPrice.value * 0.21,
    }),
  });
  if (response.ok) {
    tBody.innerHTML = "";
    location.reload();
  } else {
    alert("No se ha podido introducir el pedido");
  }
}

async function updateUser(user) {
  const API_URL = "?controller=api&action=updateUser";
  const question = confirm(
    `¿Estás seguro que quieres EDITAR al usuario con ID ${user.userId}?`
  );
  if (question) {
    const response = await fetch(API_URL, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        user_id: user.userId,
        name: user.name,
        last_name: user.lastName,
        address: user.address ?? null,
        phone: user.phone,
        mail: user.mail,
        pass: user.pass,
        role: user.role,
        city: user.city,
        cp: user.cp,
      }),
    });

    console.log(response);

    if (response.ok) {
      alert("Usuario editado con éxito");
      createHTMLTable(allUsers);
    } else {
      const data = await response.json();
      alert(data.message);
    }
  }
}

function addConfirmButton(row) {
  const confirmButton = row.querySelector(".update-order-button");
  confirmButton.removeAttribute("hidden");
}

// userFilter.addEventListener("input", (e) => {
//   e.preventDefault();
//   const userId = e.target.value;

//   if (!userId) {
//     createHTMLTable(allOrders);
//   } else {
//     const newOrderList = allOrders.filter((e) => e.userId == userId);

//     createHTMLTable(newOrderList);
//   }
// });

// let dateFromFilter;
// let dateUntilFilter;

// function applyDateFilters() {
//   let filteredOrders = allOrders;

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

// let priceFromFilter;
// let priceUntilFilter;

// function applyPriceFilters() {
//   let filteredOrders = allOrders;

//   if (priceFromFilter) {
//     filteredOrders = filteredOrders.filter(
//       (order) => order.totalAmount >= priceFromFilter
//     );
//   }

//   if (priceUntilFilter) {
//     filteredOrders = filteredOrders.filter(
//       (order) => order.totalAmount <= priceUntilFilter
//     );
//   }

//   createHTMLTable(filteredOrders);
// }

// priceFrom.addEventListener("input", (e) => {
//   e.preventDefault();
//   let priceFilter = parseFloat(e.target.value);

//   priceFromFilter = priceFilter;

//   applyPriceFilters();
// });

// priceUntil.addEventListener("input", (e) => {
//   e.preventDefault();
//   let priceFilter = parseFloat(e.target.value);

//   priceUntilFilter = priceFilter;

//   applyPriceFilters();
// });

// async function getDollar() {
//   const response = await fetch(API_URL_EXCHANGE);
//   const data = await response.json();
//   localStorage.setItem("rate", data.data.EUR);
//   createHTMLTable(allOrders);
//   toDollar.setAttribute("hidden", true);
//   toEuro.removeAttribute("hidden");
// }

// async function getEuro() {
//   const response = await fetch(API_URL_EXCHANGE);
//   const data = await response.json();
//   localStorage.removeItem("rate", data.data.EUR);
//   createHTMLTable(allOrders);
//   toEuro.setAttribute("hidden", true);
//   toDollar.removeAttribute("hidden");
// }

function setUserElements() {
  textInsert.innerText = "AÑADIR USUARIO";
  userBtn.classList.add("snd-btn-selected");
  btnActivity.classList.remove("snd-btn-selected");
  orderBtn.classList.remove("snd-btn-selected");
  btnToggle.removeAttribute("hidden");
  priceFilter.removeAttribute("hidden", true);
  priceFilter.setAttribute("hidden", true);
  filters.removeAttribute("hidden", true);
  filters.setAttribute("hidden", true);
  table.classList.remove("mt-5");
  toDollar.removeAttribute("hidden");
  toEuro.removeAttribute("hidden");
  toDollar.setAttribute("hidden", true);
  toEuro.setAttribute("hidden", true);
}
