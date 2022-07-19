if (localStorage.getItem("confirmation")) {
} else {
  window.location = "http://localhost/dcj%20canteen/Admin/adminLogin.php";
}

let itemsOrderId = document.querySelector("table").getAttribute("data-item-id");
let itemsProduct = document.querySelector("table").getAttribute("name");
let itemsTime = document.querySelector("table").getAttribute("id");
let main = document.querySelector(".main");
let popup = document.querySelector(".popup");

let products = [];
let test = [];
let rows = [];
let rows1 = [];
let template;

let time = itemsTime.split("!");
itemsOrderId = itemsOrderId.split("!");
itemsProduct = itemsProduct.split("!");

//Creating time stamp
// let ctime = new Date().getTime();

// let ntime = time[1] - ctime;

// let mint = Math.floor(ntime / 60000);
// let seconds = ((ntime % 60000) / 1000).toFixed(0);

for (let i = 0; i < itemsProduct.length; i++) {
  products.push(JSON.parse(itemsProduct[i]));
  products[i].orderId = itemsOrderId[i];
}

for (const i of itemsOrderId) {
  test.push({ orderid: i });
}

function run() {
  for (let i = 0; i < time.length; i++) {
    for (let j = 0; j < test.length; j++) {
      if (i == j) {
        let ctime = new Date().getTime();
        let ntime = time[i] - ctime;
        let mint = Math.floor(ntime / 60000);
        let seconds = ((ntime % 60000) / 1000).toFixed(0);
        if (seconds < 10 && seconds > 0) {
          seconds = `0${seconds}`;
        }
        test[j].time = time[i];
        test[j].mint = mint;
        test[j].sec = seconds;
      }
    }
  }
  rows1 = document.getElementsByTagName("table")[0].rows;
  for (let i = -10; i < rows1.length; i++) {
    if (rows1.length > 1) {
      rows1[1].remove();
    }
  }
  for (const item of test) {
    template = `
    <td><button class="orderId" id=${item.orderid}>${item.orderid}</button></td>
    <td><button class="delivered">Delivered</button></td>
    <td>${item.mint} : ${item.sec}</br><button class="addTime">+ 5</button></td>
    `;
    el = document.createElement("tr");
    el.innerHTML = template;
    main.querySelector("table tbody").appendChild(el);
  }
  document.querySelectorAll("button").forEach((i) => {
    i.addEventListener("click", () => {
      /*emptying the detail table */
      rows = document.getElementsByTagName("table")[1].rows;
      for (let i = 0; i < rows.length; i++) {
        if (rows.length > 1) {
          rows[1].remove();
        }
      }
      /* showing detail of the order */
      for (const id of itemsOrderId) {
        if (i.getAttribute("id") == id) {
          for (const item of products) {
            if (item.orderId == i.getAttribute("id")) {
              for (const items of item) {
                template = `
                      <td>${items.title}</td>
                      <td>${items.price}</td>
                      <td>${items.quantity}</td>
                      `;
                el1 = document.createElement("tr");
                el1.innerHTML = template;
                popup.querySelector("table tbody").appendChild(el1);
              }
            }
          }
        }
      }
    });
  });

  document.querySelectorAll(".delivered").forEach((i) => {
    i.addEventListener("click", (e) => {
      orderId =
        e.target.parentNode.parentNode.firstChild.nextSibling.firstChild.getAttribute(
          "id"
        );
      fetch(
        `http://localhost/dcj%20canteen/Admin/deleteOrder.php?order=${orderId}`
      )
        .then((res) => res.text())
        .then((res) => location.reload());
    });
  });
  document.querySelectorAll(".addTime").forEach((i) => {
    i.addEventListener("click", (e) => {
      orderId =
        e.target.parentNode.parentNode.firstChild.nextSibling.firstChild.getAttribute(
          "id"
        );
      for (const item of test) {
        if (orderId == item.orderid) {
          ntime = parseInt(item.time) + 300000;
          fetch(
            `http://localhost/dcj%20canteen/Admin/addTime.php?id=${item.orderid}&time=${ntime}`
          )
            .then((res) => res.text())
            .then((res) => {
              e.target.parentNode.innerHTML = `${item.mint + 5} : ${
                item.sec
              }</br><button class="addTime">+ 5</button>`;
              location.reload();
            });
        }
      }
    });
  });
}
setInterval(run, 1000);

document.querySelector("#logout").addEventListener("click", () => {
  localStorage.removeItem("confirmation");
});
