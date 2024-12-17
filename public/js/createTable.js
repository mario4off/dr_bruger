import { Order } from "/drburger.com/public/js/models/Order.js";

const API_URL = "?controller=api&action=show";

const orderSelect = document.getElementById("select-order");
const tBody = document.querySelector("tbody");
const userFilter = document.querySelector("#user-filter");
console.log(userFilter);

let allOrders = [];

document.addEventListener("DOMContentLoaded", initTable);

async function initTable() {
  const response = await fetch(API_URL);
  const data = await response.json();

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
  console.log(allOrders);

  createHTMLTable(allOrders);

  tBody.addEventListener("click", (e) => {
    const cell = e.target;

    if (cell.cellIndex == 2 || cell.cellIndex == 4) {
      const currenValue = cell.innerText;
      const row = cell.parentElement;
      const cellNumCard = row.children[5];

      switch (cell.cellIndex) {
        case 2:
          cell.innerHTML = `<select class="mod" value="${currenValue}"><option>Pendiente de aceptación</option>
      <option>En preparación</option><option>Listo para recoger</option><option>Recogido/Enviado</option></select>`;
          addConfirmButton(row);
          break;
        case 4:
          cell.innerHTML = `<select class="mod card-input" value="${currenValue}"><option>Efectivo</option>
      <option>Tarjeta</option><option>PayPal</option></select>`;
          document
            .querySelector(".card-input")
            .addEventListener("change", (e) => {
              e.preventDefault();

              cellNumCard.innerText = "";

              if (e.target.value === "Tarjeta") {
                alert("Introduce los últimos 4 dígitos de la tarjeta de pago.");

                cellNumCard.innerHTML = `<input class="mod card-num-input" type="number" value="${currenValue}" maxlength="4" pattern="[0-9]* required">`;
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
      input.focus();

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
          case 5:
            allOrders = allOrders.map((e) => {
              if (e.orderId == orderId) {
                e.cardNumber = updateValue;
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

  orderSelect.addEventListener("change", () => {
    const option = orderSelect.value;

    console.log(option);

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

function createHTMLTable(data) {
  tBody.innerHTML = "";
  for (const obj of data) {
    const tr = document.createElement("tr");
    tr.innerHTML = `
<td class="text-center border-table">${obj.orderId ?? "-"}</td>
<td class="text-center border-table">${obj.userId ?? "-"}</td>
<td class="text-center border-table">${obj.status ?? "-"}</td>
<td class="text-center border-table">${obj.dateTime ?? "-"}</td>
<td class="text-center border-table">${obj.paymentMethod ?? "-"}</td>
<td class="text-center border-table">${
      obj.cardNumber == null ? "-" : `···· ${obj.cardNumber}`
    }</td>
<td class="text-center border-table">${obj.comments ?? "-"}</td>
<td class="text-center border-table">${obj.totalAmount ?? "-"}</td>
<td class="text-center border-table">${obj.iva ?? "-"}</td>
<td class="text-center border-table">${obj.promotionId ?? "-"}</td>
<td class="text-center border-table">${obj.deliveryPrice ?? "-"}</td>
<td class="text-center border-table"><div class="d-flex gap-3"><button data-id="${
      obj.orderId
    }" class="update-order-button order-button" hidden><i class="fa-solid fa-check"></i></button><button data-id="${
      obj.orderId
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
      const order = allOrders.find((order) => order.orderId == id);

      if (order.paymentMethod != "Tarjeta") {
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

    console.log(response);

    if (response.ok) {
      alert("Pedido el eliminado con éxito");
      document.querySelector(`button[data-id="${id}"]`).closest("tr").remove();
    } else {
      alert("No se pudo eliminar el pedido.");
    }
  }
}

async function updateOrder(order) {
  console.log(allOrders);
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
      alert("No se pudo editar el pedido.");
    }
  }
}

function addConfirmButton(row) {
  const confirmButton = row.querySelector(".update-order-button");
  confirmButton.removeAttribute("hidden");
}

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
