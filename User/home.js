let categories = [
  { name: "Snacks", img: "./Assests/eatables.svg" },
  { name: "Drinks", img: "./Assests/drinks.svg" },
  { name: "Shakes", img: "./Assests/shakes.svg" },
];

let images = document.querySelectorAll(".img");
let removebtn = document.querySelector("#remove");
let sidebar = document.querySelector("#sidebar");
let productCards = document.querySelectorAll(".productCard");
let cartIcon = document.querySelector("#navCart");
let cart = document.querySelector("#cart");
let cartItems = [];
let cartTotal = [];
let checkout = [];
let uniqueItem = [];
let totalQuantity = "";
let totalPrice = "";

// creating an element "div", giving it a classname, inserting the dynamic html in the element, then appending the element in sidebar.
for (const item of categories) {
  let div = document.createElement("div");

  div.addEventListener("click", () => {
    console.log(item.name, " is clicked!");
    window.location.href = `home.php#${item.name.toLowerCase()}`;
  });

  div.className = "sidebarItems";

  div.innerHTML = `<h3>${item.name}</h3><img src="${item.img}" alt="eatables" class="sidebarIcons"/>`;

  sidebar.appendChild(div);
}

for (const productCard of productCards) {
  productCard.querySelector(".addToCartBtn").addEventListener("click", () => {
    let x = document.getElementById("snackbar");

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function () {
      x.className = x.className.replace("show", "");
    }, 3000);

    cart.querySelector("table tbody").innerHTML = "";
    let temp = `
    <tr>
    <th>Item</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Remove</th>
    </tr>`;
    cart.querySelector("table tbody").innerHTML = temp;
    cartItems.push({
      productId: productCard.getAttribute("data-item-id"),
      title: productCard.querySelector(".productSubtext h3").innerText,
      price: productCard.querySelector(".productSubtext div span").innerText,
      imgsrc: productCard.querySelector("img").getAttribute("src"),
    });

    uniqueItem = [...new Set(cartItems.map((v) => JSON.stringify(v)))];
    cartTotal = uniqueItem;
    // console.log(cartItems);
    itemIterator(uniqueItem);

    let subTotal = cartItems
      .map((v) => parseInt(v.price.replace("₹", "")))
      .reduce((v, c) => v + c);
    document.querySelector(
      "#subTotal"
    ).innerHTML = `<b>Subtotal</b> : ${subTotal}`;
  });
}

function itemIterator(array) {
  for (let item of array) {
    // console.log(JSON.parse(item));
    item = JSON.parse(item);
    let tag = createCartItem({
      productId: item.productId,
      title: item.title,
      imgSrc: item.imgsrc,
      price: item.price,
      quantity: cartItems.filter((v) => v.productId == item.productId).length,
    });

    cart.querySelector("table tbody").appendChild(tag);
  }
}
function createCartItem({ productId, title, imgSrc, quantity, price }) {
  let template2 = `<td class="itemTD">
            <div class="cartItem">
              <img
                class="cartImg"
                src="${imgSrc}"
                alt=""
                />
                <span>${title}</span>
                </div>
                </td>
                <td>${quantity}</td>
                <td>${
                  parseInt(quantity) * parseInt(price.replace("₹", ""))
                }</td>
                <td><span  class="material-icons removeButton">delete</span></td>`;

  let el = document.createElement("tr");
  el.setAttribute("data-item-id", `${productId}`);
  el.innerHTML = template2;
  el.querySelector(".removeButton").addEventListener("click", (e) => {
    cartItems = cartItems.filter((v) => v.productId != productId);

    e.target.parentNode.parentNode.remove();
  });

  return el;
}

cartIcon.addEventListener("click", () => {
  cart.style.display = cart.style.display == "block" ? "none" : "block";
});

document.querySelector("#buy").addEventListener("click", () => {
  cartTotal.forEach((v) => {
    v = JSON.parse(v);
    v["quantity"] = cartItems.filter((p) => p.productId == v.productId).length;
    v["price"] = parseInt(v["price"].replace("₹", ""));
    checkout.push(v);
  });
  if (checkout.length != 0) {
    let ntime = time();
    ntime += 600000;
    let oid = random();
    fetch(
      `http://localhost/dcj%20canteen/User/addOrder.php?id=${oid}&p=${JSON.stringify(
        checkout
      )}&time=${ntime}`
    );
    window.localStorage.setItem("id", oid);
    window.location = "http://localhost/dcj%20canteen/User/orderPlaced.html";
  } else {
    alert("Order something");
  }
});

function time() {
  return new Date().getTime();
}
function random() {
  let alpha = "";
  let gamma = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  for (let i = 0; i < 10; i++) {
    alpha += gamma[Math.floor(Math.random() * (36 - 1) + 1)];
  }
  return alpha;
}
