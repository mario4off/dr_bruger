const select = (el) => document.getElementById(el);
const setRequired = (el) => (el.required = true);
const unsetRequired = (el) => (el.required = false);

const inputCard = select("input-card");
const inputCash = select("input-cash");
const inputPaypal = select("input-paypal");
const form = select("form-checkout");

const cardNum = select("event-num");
const cardExpiration = select("event-expiration");
const cardCvv = select("event-cvv");
const cardName = select("event-name");
const collapseElement = select("collapse-Element");
const collapseExample = select("collapseExample");

inputCard.addEventListener("click", () => {
  let isExpanded = collapseElement.getAttribute("aria-expanded");
  let isCollapsed = collapseElement.getAttribute("aria-expanded");
  console.log(`CollapsedElement es ${isExpanded}`);

  if (isExpanded == "true") {
    setRequired(cardNum);
    setRequired(cardExpiration);
    setRequired(cardCvv);
    setRequired(cardName);
  } else {
    removeRequired();
  }
});

inputCash.addEventListener("click", removeRequired);
inputPaypal.addEventListener("click", removeRequired);

function removeRequired() {
  let isExpanded = collapseElement.getAttribute("aria-expanded");
  collapseElement.setAttribute("aria-expanded", "false");
  collapseExample.classList.remove("show");
  console.log("PATATA");
  unsetRequired(cardNum);
  unsetRequired(cardExpiration);
  unsetRequired(cardCvv);
  unsetRequired(cardName);
  cardNum.value = "";
  cardExpiration.value = "";
  cardCvv.value = "";
  cardName.value = "";
  collapseElement.value = "";
}