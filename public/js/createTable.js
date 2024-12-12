import { Order } from "/drburger.com/public/js/models/Order.js";

const API_URL = "?controller=api&action=show";

const button = document.getElementById("save-btn");

document.addEventListener("DOMContentLoaded", initTable);

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
  const tBody = document.querySelector("tbody");
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

  const orderSelect = document.getElementById("select-order");
  button.addEventListener("click", updateData);
  orderSelect.addEventListener("change", () => {
    const option = orderSelect.value;

    console.log(option);

    tBody.innerHTML = "";

    const newOrder = allOrders.sort((a, b) => a[option] - b[option]);

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

async function updateData() {
  const ordersToUpdate = [];

  for (const orderId of Object.keys(sessionStorage)) {
    const order = JSON.parse(sessionStorage.getItem(orderId));
    order.orderId = orderId;
    ordersToUpdate.push(order);
  }
  console.log(ordersToUpdate);
}

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
<td class="text-center border-table"><button class="button-to-link" ><i class="fa-solid fa-trash"></i></button></td>
`;
    tBody.append(tr);
  }
}
