import { Order } from "/drburger.com/public/js/models/Order.js";
//Impotamos la clase order

// En primer lugar se ha establecido la ruta para cargar todos los datos de la api
const API_URL = "?controller=api&action=show";
// A continuación se establece la ruta y la clave de la api de free currency
const API_URL_EXCHANGE =
  "https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_UXueennePKw2L8XXZXJeraNXgruKGimO7dVZYM5w";
const API_KEY = "fca_live_UXueennePKw2L8XXZXJeraNXgruKGimO7dVZYM5w";
// Con una asiganación a una variable de la función queryselector se crea una versión reducida del selector y se
// se recogen todos los elementos que interesan del dom
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
const orderFilters = select("#order-filter");
const productBtn = select("#product-btn");
const activityBtn = select("#activity-btn");
const inputUser = select("#input-user");
const inputPayment = select("#input-payment");
const inputNum = select("#input-card");
const inputAllergies = select("#input-allergies");
const inputPrice = select("#input-total-price");
const inputDelivery = select("#input-delivery");
const btnInsertOrder = select("#btn-insert-order");
const btnInsertUser = select("#btn-insert-user");
const divOrder = select("#div-insert-order");
const divUser = select("#div-insert-user");
const textInsert = select("#text-insert");

// Este evento hace que se inicia la tbla correctamente al hacer click en el botón de pedidos
orderBtn.addEventListener("click", () => {
  setOrderElements();
  initTable();
});
// Evento que inserta el pedido cuando el desplegable está baierto
btnInsertOrder.addEventListener("click", (e) => {
  e.preventDefault();
  insertOrder();
});
// Se configuran los eventos del botón que gestiona el cambio de divisa
toDollar.addEventListener("click", getDollar);
toEuro.addEventListener("click", getEuro);

const orderSelect = document.getElementById("select-order");

let allOrders = [];
let headersOrders = [
  "PEDIDO",
  "USUARIO",
  "ESTADO",
  "FECHA",
  "MÉTODO",
  "NÚM",
  "ALERGIAS",
  "PRECIO",
  "IVA",
  "PROMOCION",
  "ENVÍO",
];
// Se configura que por defecto al cargar el dom se cargue la tabla de pedidos con el método initTable
document.addEventListener("DOMContentLoaded", initTable);

async function initTable() {
  const response = await fetch(API_URL);
  const data = await response.json();

  // Gestiona los estados selected de los botones
  orderBtn.classList.add("snd-btn-selected");
  userBtn.classList.remove("snd-btn-selected");
  activityBtn.classList.remove("snd-btn-selected");

  // Gestiona el estado del botón de divisa
  if (localStorage.getItem("rate")) {
    toEuro.removeAttribute("hidden");
  } else {
    toDollar.removeAttribute("hidden");
  }
  // Al obtener la respuesta de la api con los pedidos nos aseguramos que el array de pedidos esté vacío
  // y lo completamos con objetos de tipo order
  allOrders.splice(0, allOrders.length);
  if (!response.ok) {
    table.innerHTML = "<p>No hay pedidos por mostrar</p>";
  } else {
    for (const el of data.data) {
      allOrders.push(
        new Order(
          el.order_id,
          el.user_id,
          el.promotion_id,
          el.date_time,
          el.status,
          el.allergies_comments,
          el.payment_method,
          el.card_number,
          el.iva,
          el.delivery_cost,
          el.total_amount
        )
      );
    }

    // Lo pasamos a la función que crea la tabla HTML con los datos de la api
    createHTMLTable(allOrders);

    tBody.addEventListener("click", (e) => {
      // Este evento gestiona la mopdificación haciendo click en las casillas de estado y metodo de pago
      // al hacer click se enfoca directamente al elemento del dom y podemos obtener sus datos y los
      //del nodo padre que sería el tr
      const cell = e.target;

      if (cell.cellIndex == 2 || cell.cellIndex == 4) {
        const currenValue = cell.innerText;
        const row = cell.parentElement;
        const cellNumCard = row.children[5];

        // Dependiendo de la celda se incrusta un HTML u otro y se añaden botones de confirmación del update
        switch (cell.cellIndex) {
          case 2:
            cell.innerHTML = `<select class="mod" value="${currenValue}"><option>Pendiente</option>
      <option>En preparación</option><option>Listo para recoger</option><option>Recogido/Enviado</option></select>`;
            addConfirmButton(row);
            break;
          case 4:
            cell.innerHTML = `<select class="mod card-input" value="${currenValue}"><option>Efectivo</option>
      <option>Tarjeta</option><option>PayPal</option></select>`;
            //Con este evento hacemos que el usuario al introducir tarjeta como método de pago deba cambiar los dígitos de la tarjerta
            document
              .querySelector(".card-input")
              .addEventListener("change", (e) => {
                e.preventDefault();

                cellNumCard.innerText = "";
                // Esto se accionna cuando se evalúa el contenido del input/td seleccionado
                if (e.target.value === "Tarjeta") {
                  alert(
                    "Introduce los últimos 4 dígitos de la tarjeta de pago."
                  );

                  cellNumCard.innerHTML = `<input class="mod card-num-input" type="number" value="${currenValue}" maxlength="3" pattern="[0-9]* required">`;

                  const inputCardNum =
                    cellNumCard.querySelector(".card-num-input");
                  //El último evento de la casilla hace que al hacer lick fuera de ella se guarde el nuevo valor
                  inputCardNum.addEventListener("blur", () => {
                    if (inputCardNum.value.length == 4) {
                      cellNumCard.innerHTML = "···· " + inputCardNum.value;
                    } else {
                      cellNumCard.innerHTML = "Núm. error";
                    }

                    const orderId =
                      cell.parentElement.querySelector("td").innerHTML;
                    // Aqu;i actualizamos el valor a través de la función map de los cambios en el número de tarjeta
                    allOrders = allOrders.map((e) => {
                      if (e.orderId == orderId) {
                        e.cardNumber = inputCardNum.value;
                      }
                      return e;
                    });
                  });
                  // Si no son tarjeta el método dee pago se pone un guión en el número de tarjeta
                } else if (
                  e.target.value === "PayPal" ||
                  e.target.value === "Efectivo"
                ) {
                  cellNumCard.innerHTML = "-";
                }
              });
            addConfirmButton(row);
            break;

          default:
            console.log("Campo no disponible para edición");
        }
        const input = cell.querySelector(".mod");
        // Se centra el cursor en el input
        input.focus();
        // Se an1ade un nuevo evento que lo que hará será al clicar fuera del input actualizar el método de pago o
        // el estado del pedido dependiendo de la celda clicada con la función map
        input.addEventListener("blur", () => {
          const updateValue = input.value;

          cell.innerHTML = updateValue;
          const orderId = cell.parentElement.querySelector("td").innerHTML;
          switch (cell.cellIndex) {
            case 2:
              allOrders = allOrders.map((e) => {
                if (e.orderId == orderId) {
                  e.status = updateValue;
                }
                return e;
              });
              break;
            case 4:
              allOrders = allOrders.map((e) => {
                if (e.orderId == orderId) {
                  e.paymentMethod = updateValue;
                }
                return e;
              });
              break;
            default:
              console.log(
                "El índice pertenece a una casilla que no se puede modificar"
              );
              break;
          }
        });
      }
    });

    // Este evento gestiona el orden con el que se muestra la tabla reordenando el array con la función sort
    // y se activa con un cambio en el input select
    orderSelect.addEventListener("change", () => {
      const option = orderSelect.value;

      let newOrder = "";

      if (option == "dateTime") {
        newOrder = allOrders.sort(
          (a, b) => new Date(a[option]) - new Date(b[option])
        );
      } else {
        newOrder = allOrders.sort((a, b) => a[option] - b[option]);
      }

      console.log(newOrder);

      createHTMLTable(newOrder);
    });
  }
}

// Esta función gestiona la creación de la tabla HTML
function createHTMLTable(data, headers = headersOrders) {
  // Primero la vacía para asegurarse de que no se duplican datos
  tBody.innerHTML = "";
  tHead.innerHTML = "";

  // Primero crea los encabezados
  const tr = document.createElement("tr");
  for (const header of headers) {
    const th = document.createElement("th");
    th.innerText = header;
    tr.append(th);
    th.classList.add("text-center");
    th.classList.add("align-top");
  }
  tHead.append(tr);

  // Se hace aqu;i la gestión de localstorage para personalizar el uso de la divisa
  let rate = 1;
  let currency = "€";

  // Si existe la divisa se aplican dolares, si no, se aplican euros al cambio obtenido de la api.
  // Se multiplicarán las cantidades con este índice al crear la tbla y se añadirá el símbolo de divisa
  if (localStorage.getItem("rate")) {
    rate = localStorage.getItem("rate");
    currency = "$";
  }

  // A contninuación con los objetos Order obtenidos de la api se completa la tabla
  for (const obj of data) {
    const tr = document.createElement("tr");

    tr.innerHTML = `
<td class="text-center border-table">${obj.orderId ?? "-"}</td>
<td class="text-center border-table">${obj.userId ?? "-"}</td>
<td class="text-center border-table edit-td">${
      obj.status ?? "-"
    } <i class="fa-solid fa-pencil"></i></td>
<td class="text-center border-table">${obj.dateTime ?? "-"}</td>
<td class="text-center border-table edit-td">${
      obj.paymentMethod ?? "-"
    } <i class="fa-solid fa-pencil align-self-end"></i></td>
<td class="text-center border-table">${
      obj.cardNumber == null ? "-" : `···· ${obj.cardNumber}`
    }</td>
<td class="text-center border-table">${obj.comments ?? "-"}</td>
<td class="text-center border-table">${
      (obj.totalAmount / rate).toFixed(2) ?? "-"
    } ${currency}</td>
<td class="text-center border-table">${
      (obj.iva / rate).toFixed(2) ?? "-"
    } ${currency}</td>
<td class="text-center border-table">${obj.promotionId ?? "-"}</td>
<td class="text-center border-table">${
      (obj.deliveryPrice / rate).toFixed(2) ?? "-"
    } ${currency}</td>
<td class="text-center border-table"><div class="d-flex gap-3"><button data-id="${
      obj.orderId
    }" class="update-order-button order-button" hidden><i class="fa-solid fa-check"></i></button><button data-id="${
      obj.orderId
    }" class="remove-order-button order-button"><i class="fa-solid fa-trash"></i></button></div></td>
`;
    tBody.append(tr);
  }

  // Se capturan los elmentos para crear los botones de eliminar y actualizar añadiendo los eventos a cada uno en bucle
  const updateButtons = document.querySelectorAll(".update-order-button");
  const removeButtons = document.querySelectorAll(".remove-order-button");

  for (const button of updateButtons) {
    button.addEventListener("click", (e) => {
      const buttonSelected = e.target.closest(".update-order-button");
      buttonSelected.setAttribute("hidden", true);
      const id = buttonSelected.getAttribute("data-id");
      const order = allOrders.find((order) => order.orderId == id);

      if (order.paymentMethod !== "Tarjeta") {
        order.cardNumber = null;
      }

      updateOrder(order);
    });
  }

  for (const button of removeButtons) {
    button.addEventListener("click", (e) => {
      const buttonSelected = e.target.closest(".remove-order-button");
      const id = buttonSelected.getAttribute("data-id");
      removeOrder(id);
    });
  }
}

// función asíncrona que gestiona el borrado de pedidos
async function removeOrder(id) {
  const API_URL = "?controller=api&action=deleteOrder";
  const question = confirm(
    `¿Estás seguro que quieres ELIMINAR el pedido con ID ${id}?`
  );
  if (question) {
    const response = await fetch(API_URL, {
      method: "DELETE",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(id),
    });

    if (response.ok) {
      alert("Pedido el eliminado con éxito");
      document.querySelector(`button[data-id="${id}"]`).closest("tr").remove();
    } else {
      alert("No se pudo eliminar el pedido.");
    }
  }
}

// función asíncrona que gestiona el insert de pedidos
async function insertOrder() {
  const API_URL = "?controller=api&action=createOrder";

  const response = await fetch(API_URL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      userId: inputUser.value,
      status: "En preparación",
      paymentMethod: inputPayment.value,
      cardNumber: inputNum.value ?? null,
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

// función asíncrona que gestiona el update de pedidos
async function updateOrder(order) {
  const API_URL = "?controller=api&action=updateOrder";
  const question = confirm(
    `¿Estás seguro que quieres EDITAR el pedido con ID ${order.orderId}?`
  );
  if (question) {
    const response = await fetch(API_URL, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        id: order.orderId,
        status: order.status,
        paymentMethod: order.paymentMethod,
        cardNumber: order.cardNumber == "-" ? null : order.cardNumber,
      }),
    });

    console.log(response);

    if (response.ok) {
      alert("Pedido editado con éxito");
      createHTMLTable(allOrders);
    } else {
      const data = await response.json();
      alert(data.message);
    }
  }
}

// Función que añade el boton de aceptar actualización
function addConfirmButton(row) {
  const confirmButton = row.querySelector(".update-order-button");
  confirmButton.removeAttribute("hidden");
}

// Gestión con filter del input que obtiene del array los usuarios con el mismo id
userFilter.addEventListener("input", (e) => {
  e.preventDefault();
  const userId = e.target.value;

  if (!userId) {
    createHTMLTable(allOrders);
  } else {
    const newOrderList = allOrders.filter((e) => e.userId == userId);

    createHTMLTable(newOrderList);
  }
});

// El filtro de la fecha se hace con una función para el desde, otra para el hasta y otra que las une y permite aplicar ambos
// filtros al mismo tiempo.
let dateFromFilter;
let dateUntilFilter;

function applyDateFilters() {
  // Esta función es la que comprueba si existen ambos filtros y aplica mbios mostrando un nuevo array
  // con comparaciones de tipodate y filter para terminar creandoi de nuevo la tabla
  let filteredOrders = allOrders;

  if (dateFromFilter) {
    filteredOrders = filteredOrders.filter(
      (order) => new Date(order.dateTime) >= dateFromFilter
    );
  }

  if (dateUntilFilter) {
    filteredOrders = filteredOrders.filter(
      (order) => new Date(order.dateTime) <= dateUntilFilter
    );
  }

  createHTMLTable(filteredOrders);
}

dateFrom.addEventListener("input", (e) => {
  e.preventDefault();
  let dateFilter = e.target.value;
  // El evento siempre que se dispara converite el valore en tipo date
  dateFromFilter = dateFilter ? new Date(dateFilter) : null;
  if (dateFromFilter) {
    // Utiliza el segundo 0 del día para incluir todo el día
    dateFromFilter.setHours(0, 0, 0);
  }

  applyDateFilters();
});

dateUntil.addEventListener("input", (e) => {
  e.preventDefault();
  let dateFilter = e.target.value;
  // El evento siempre que se dispara converite el valore en tipo date
  dateUntilFilter = dateFilter ? new Date(dateFilter) : null;
  if (dateUntilFilter) {
    // Se ponen las 12 de la noche para incluir también el último dái
    dateUntilFilter.setHours(23, 59, 59);
  }

  applyDateFilters();
});

// Con los precios se ha hecho lo mismo que con fechas pero en vez de utilizar objetos date se
// ha parseado a float las cifras y ordenarlas con la función filter
let priceFromFilter;
let priceUntilFilter;

function applyPriceFilters() {
  let filteredOrders = allOrders;

  if (priceFromFilter) {
    filteredOrders = filteredOrders.filter(
      (order) => order.totalAmount >= priceFromFilter
    );
  }

  if (priceUntilFilter) {
    filteredOrders = filteredOrders.filter(
      (order) => order.totalAmount <= priceUntilFilter
    );
  }

  createHTMLTable(filteredOrders);
}

priceFrom.addEventListener("input", (e) => {
  e.preventDefault();
  let priceFilter = parseFloat(e.target.value);

  priceFromFilter = priceFilter;

  applyPriceFilters();
});

priceUntil.addEventListener("input", (e) => {
  e.preventDefault();
  let priceFilter = parseFloat(e.target.value);

  priceUntilFilter = priceFilter;

  applyPriceFilters();
});
// Función asíncrona que llama a la api y btiene el cambio y lo guarda en el local storage para aplicarlo
async function getDollar() {
  const response = await fetch(API_URL_EXCHANGE);
  const data = await response.json();
  localStorage.setItem("rate", data.data.EUR);
  createHTMLTable(allOrders);
  toDollar.setAttribute("hidden", true);
  toEuro.removeAttribute("hidden");
}
// Gestiona el cambio a euro quitando del local storage la divisa
async function getEuro() {
  const response = await fetch(API_URL_EXCHANGE);
  const data = await response.json();
  localStorage.removeItem("rate", data.data.EUR);
  createHTMLTable(allOrders);
  toEuro.setAttribute("hidden", true);
  toDollar.removeAttribute("hidden");
}

// Está es una función que establece el estado predeterminado de los elementos HTML cuando se está en la sección
// de pedidos en el panel de admin
function setOrderElements() {
  textInsert.innerText = "AÑADIR PEDIDO";
  orderBtn.classList.add("snd-btn-selected");
  btnActivity.classList.remove("snd-btn-selected");
  btnInsertOrder.removeAttribute("hidden");
  btnInsertUser.setAttribute("hidden", true);
  orderFilters.removeAttribute("hidden");
  btnToggle.removeAttribute("hidden");
  priceFilter.removeAttribute("hidden", true);
  filters.removeAttribute("hidden", true);
  //   filters.classList.add("mt-5");
  divOrder.removeAttribute("hidden");
  divUser.removeAttribute("hidden");
  divOrder.classList.add("d-flex");
  divOrder.classList.add("gap-4");
  divUser.classList.remove("d-flex");
  divUser.classList.remove("gap-4");
  divUser.setAttribute("hidden", true);
  table.classList.remove("mt-5");
  toEuro.setAttribute("hidden", true);
  toDollar.setAttribute("hidden", true);
  if (localStorage.getItem("rate")) {
    toEuro.removeAttribute("hidden");
  } else {
    toDollar.removeAttribute("hidden");
  }
}
