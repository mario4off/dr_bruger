import { Order } from "/drburger.com/public/js/models/Order.js";

const API_URL = "?controller=api&action=show";

document.addEventListener("DOMContentLoaded", createTable());

async function createTable() {
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
  for (const obj of allOrders) {
    const tr = document.createElement("tr");
    tr.innerHTML = `<th></th>
<th>${obj.orderId}</th>
<th>${obj.userId}</th>
<th>${obj.promotionId}</th>
<th>${obj.dateTime}</th>
<th>${obj.status}</th>
<th>${obj.comments}</th>
<th>${obj.paymentMethod}</th>
<th>${obj.cardNumber}</th>
<th>${obj.deliveryPrice}</th>
<th>${obj.totalAmount}</th>`;
    tBody.append(tr);
  }
}
