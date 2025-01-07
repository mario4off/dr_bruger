// Se importa la clase User

import { User } from "/drburger.com/public/js/models/User.js";
// Con una asiganación a una variable de la función queryselector se crea una versión reducida del selector y se
// se recogen todos los elementos que interesan del dom
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
const btnProduct = select("#product-btn");
const phone = select("#input-phone");
const address = select("#input-address");
const role = select("#input-role");
const city = select("#input-city");
const cp = select("#input-cp");

// Se asocia al botón de la barra lateral el iniciar la tabla e inicializar los elementos HTML en el estado adecuado
// para mostrar usuarios
userBtn.addEventListener("click", () => {
  setUserElements();
  initTable();
});

// Evento de click que activa el insert con desplegable abierto
btnInsertUser.addEventListener("click", (e) => {
  e.preventDefault();
  insertUser();
});

// Array que almacenará todos los objetos users y que configura la tabla
let allUsers = [];

// Función asíncrona que inicia la tabla con los datos de la api
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
          el.pass,
          el.city,
          el.cp
        )
      );
    }

    //  Se crea la tabla con los datos de la llamada a la api

    createHTMLTable(allUsers);

    // e configura un evento de click en el body de la tabla para permitir modidicaciones en la tabla
    tBody.addEventListener("click", (e) => {
      const cell = e.target;
      // Cuando el índice de la fila es el 6 el td incluye un select quer permite cambiar el rol del usuario
      if (cell.cellIndex == 6) {
        const currenValue = cell.innerText;
        const row = cell.parentElement;

        cell.innerHTML = `<select class="mod" value="${currenValue}"><option>Selecciona rol</option>
      <option>customer</option><option>admin</option></select>`;
        addConfirmButton(row);

        const input = cell.querySelector(".mod");
        input.focus();

        // El efecto blur hace que al hacer click fuera de la celda se haga el cambio en la tabla alterando también el array
        input.addEventListener("blur", () => {
          const updateValue = input.value;

          cell.innerHTML = updateValue;
          const userId = cell.parentElement.querySelector("td").innerHTML;
          // El array se altera con la función map
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

// Función que crea la tabla con los datos que se le pasan como argument
function createHTMLTable(data) {
  tBody.innerHTML = "";
  tHead.innerHTML = "";
  // Se vacía y se crea el encabezado de la tabla
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

  // Para el tbody se cogen los datos del array y se crea la tabla de usuarios usando las propiedades de los objetos User
  for (const obj of data) {
    const tr = document.createElement("tr");

    tr.innerHTML = `
    <td class="text-center border-table">${obj.userId ?? "-"}</td>
    <td class="text-center border-table">${obj.name.toUpperCase() ?? "-"}</td>
        <td class="text-center border-table">${
          obj.lastName.toUpperCase() ?? "-"
        }</td>
    <td class="text-center border-table">${
      obj.address.toUpperCase() ?? "-"
    }</td>
<td class="text-center border-table">${obj.mail ?? "-"}</td>
<td class="text-center border-table">${obj.phone ?? "-"}</td>
    <td class="text-center border-table edit-td">${
      obj.role ?? "-"
    } <i class="fa-solid fa-pencil align-self-end"></i></td>
    
    <td class="text-center border-table">${obj.city.toUpperCase() ?? "-"}</td>
    <td class="text-center border-table">${obj.cp ?? "-"}</td>
    <td class="text-center border-table"><div class="d-flex gap-3"><button data-id="${
      obj.userId
    }" class="update-order-button order-button" hidden><i class="fa-solid fa-check"></i></button><button data-id="${
      obj.userId
    }" class="remove-order-button order-button"><i class="fa-solid fa-trash"></i></button></div></td>
    `;
    tBody.append(tr);
  }

  // Se configuran los botones para modificar y eliminar añadiendo evento de click que con el id activa el borrado o el update
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

// Funcióin asíncrona que gestiona el borrado de usuarios mediante el id con llamada a la api
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
      initTable();
    } else {
      alert("No se pudo eliminar al usuario.");
    }
  }
}
// Funcióin asíncrona que gestiona la inserción de usurios con llamada a la api
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
// Funcióin asíncrona que gestiona la actualización mediante el objeto user y llamada a la api
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

// Activa el botón para actualizar y confirmar
function addConfirmButton(row) {
  const confirmButton = row.querySelector(".update-order-button");
  confirmButton.removeAttribute("hidden");
}

// Está es una función que establece el estado predeterminado de los elementos HTML cuando se está en la sección
// de usuarios en el panel de admin
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
  btnProduct.classList.remove("snd-btn-selected");
  divOrder.setAttribute("hidden", true);
  btnInsertUser.removeAttribute("hidden");
  btnInsertOrder.setAttribute("hidden", true);
}
