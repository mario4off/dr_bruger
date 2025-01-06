import { User } from "/drburger.com/public/js/models/User.js";

const select = (e) => document.querySelector(e);
const tHead = select("thead");
const tBody = select("tbody");

const btnToggle = select("#accordionFlushExample");

const btnActivity = select("#activity-btn");

const priceFilter = select("#filter-price");
const textInsert = select("#text-insert");
const table = select("table");
const filters = select("#filters");
const toDollar = select("#convert-to-dollar");
const toEuro = select("#convert-to-euro");
const orderBtn = select("#order-btn");
const userBtn = select("#user-btn");
const btnInsertOrder = select("#btn-insert-order");
const btnInsertUser = select("#btn-insert-user");
const divOrder = select("#div-insert-order");
const divUser = select("#div-insert-user");
const name = select("#input-name");
const lastName = select("#input-lastname");
const mail = select("#input-mail");
const phone = select("#input-phone");
const address = select("#input-address");
const role = select("#input-role");
const city = select("#input-city");
const cp = select("#input-cp");

userBtn.addEventListener("click", () => {
  setUserElements();
  initTable();
});

btnInsertUser.addEventListener("click", (e) => {
  e.preventDefault();
  insertUser();
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
      name: name.value,
      lastName: lastName.value,
      pass: "Informatica_1",
      mail: mail.value,
      phone: phone.value,
      role: role.value,
      address: address.value,
      city: city.value,
      cp: cp.value,
    }),
  });
  if (response.ok) {
    alert("Usuario introducido con éxito");
    initTable();
  } else {
    alert("No se ha podido introducir al usuario");
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
  divOrder.removeAttribute("hidden");
  divUser.removeAttribute("hidden");
  divOrder.classList.remove("d-flex");
  divOrder.classList.remove("gap-4");
  divUser.classList.add("d-flex");
  divUser.classList.add("gap-4");
  divOrder.setAttribute("hidden", true);
  btnInsertUser.removeAttribute("hidden");
  btnInsertOrder.setAttribute("hidden", true);
}
