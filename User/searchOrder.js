let orderId = document.querySelector("input");
const button = document.querySelector("button");

button.addEventListener("click", () => {
  let id = orderId.value;
  //fetching time with order id
  fetch(`http://localhost/dcj%20canteen/User/getOrder.php?orderid=${id}`)
    .then((res) => res.text())
    .then((res) => {
      //checking if order exists
      if (res == "none") {
        document.querySelector(".text-container input").value = "";
        document
          .querySelector(".text-container input")
          .setAttribute("placeholder", "Order does not exists");
        document.querySelector(".text-container input").style.border =
          "2px solid red";
      } else {
        if (id != "") {
          document.querySelector(".order-container").style.display = "block";
          document.querySelector(".text-container input").style.border =
            "1px solid #764af1";
          function run() {
            //getting time difference in order placed and current time
            let time = res;
            let ctime = new Date().getTime();
            let ntime = time - ctime;
            let mint = Math.floor(ntime / 60000);
            let seconds = ((ntime % 60000) / 1000).toFixed(0);
            //if seconds below 10 adding a 0 to make it 2 character
            if (seconds < 10 && seconds > 0) {
              seconds = `0${seconds}`;
            }
            //checking negative time values
            if (mint < 0) {
              window.location.reload();
              let temp = `
                <td>${id}</td>
                <td>Sorry for delay</br>Its taking more then usual</td>
          `;
              el = document.createElement("tr");
              el.innerHTML = temp;
              document
                .querySelector(".order-container")
                .querySelector("table tbody")
                .appendChild(el);
              clearInterval(clear);
            } else {
              //emptying the table to overcome duplicacy
              rows = document.getElementsByTagName("table")[0].rows;
              for (let i = 0; i < rows.length; i++) {
                if (rows.length > 1) {
                  rows[1].remove();
                }
              }
              //appending in table
              let temp = `
                  <td>${id}</td>
                  <td>${mint + " : " + seconds}</td>
            `;
              el = document.createElement("tr");
              el.innerHTML = temp;
              document
                .querySelector(".order-container")
                .querySelector("table tbody")
                .appendChild(el);
            }
          }
          let clear = setInterval(run, 1000);
          // function clear() {
          //   clearInterval(run);
          // }
        } else {
          alert("Enter a Order Id");
        }
      }
    });
});
