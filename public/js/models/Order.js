export class Order {
  constructor(
    orderId,
    userId,
    promotionId,
    dateTime,
    status,
    comments,
    paymentMethod,
    cardNumber,
    iva,
    deliveryPrice,
    totalAmount
  ) {
    this.orderId = orderId;
    this.userId = userId;
    this.promotionId = promotionId;
    this.dateTime = dateTime;
    this.status = status;
    this.comments = comments;
    this.paymentMethod = paymentMethod;
    this.cardNumber = cardNumber;
    this.iva = iva;
    this.deliveryPrice = deliveryPrice;
    this.totalAmount = totalAmount;
  }
}
