import { Order } from "/drburger.com/public/js/models/Order.js";

const API_URL = "?controller=api&action=show";

const button = document.getElementById("save-btn");
const orderSelect = document.getElementById("select-order");
const tBody = document.querySelector("tbody");

document.addEventListener("DOMContentLoaded", initTable);
//button.addEventListener("click", updateData);

async function initTable() {
  const response = await fetch(API_URL);
  const data = await response.json();

  const allOrders = [];

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

  createHTMLTable(allOrders, tBody);

  tBody.addEventListener("click", (e) => {
    const cell = e.target;

    if (cell.cellIndex == 2 || cell.cellIndex == 4 || cell.cellIndex == 5) {
      const currenValue = cell.innerText;
      cell.innerHTML = `<input class="mod" type="text" value="${currenValue}">`;
      const input = cell.querySelector(".mod");
      input.focus();

      input.addEventListener("blur", () => {
        const updateValue = input.value;
        keepData(cell, updateValue);
        cell.innerHTML = updateValue;
        button.removeAttribute("hidden");
      });
    }
  });

  orderSelect.addEventListener("change", () => {
    const option = orderSelect.value;

    console.log(option);

    tBody.innerHTML = "";

    let newOrder = "";

    if (option == "dateTime") {
      newOrder = allOrders.sort(
        (a, b) => new Date(a[option]) - new Date(b[option])
      );
    } else {
      newOrder = allOrders.sort((a, b) => a[option] - b[option]);
    }

    console.log(newOrder);

    createHTMLTable(newOrder, tBody);
  });
}

function keepData(cell, change) {
  const row = cell.parentElement;
  const orderId = row.cells[0].innerText;

  let order = JSON.parse(sessionStorage.getItem(orderId)) || {};

  if (cell.cellIndex == 2) {
    order.status = change;
  } else if (cell.cellIndex == 4) {
    order.paymentMethod = change;
  } else if (cell.cellIndex == 5) {
    order.cardNumber = change;
  }
  sessionStorage.setItem(orderId, JSON.stringify(order));
}

// async function updateData() {
//   const ordersToUpdate = [];

//   for (const orderId of Object.keys(sessionStorage)) {
//     const order = JSON.parse(sessionStorage.getItem(orderId));
//     order.orderId = orderId;
//     ordersToUpdate.push(order);
//   }
//   console.log(ordersToUpdate);
// }

function createHTMLTable(data, tBody) {
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
<td class="text-center border-table"><button data-id="${
      obj.orderId
    }" class="remove-order-button"><i class="fa-solid fa-trash"></i></button></td>
`;
    tBody.append(tr);
  }

  const removeButtons = document.querySelectorAll(".remove-order-button");
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
    `¿Estás seguro que quieres elminar el pedido con ID ${id}?`
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
