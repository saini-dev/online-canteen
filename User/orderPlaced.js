if (localStorage.getItem("id")) {
  let orderId = document.querySelector("#orderId");
  let button = document.querySelector("button");
  let id = localStorage.getItem("id");

  orderId.innerHTML = `Order id : <b>${id}</b>`;
  localStorage.removeItem("id");
  button.addEventListener("click", () => {
    window.location = "http://localhost/dcj%20canteen/User/home.php";
  });
}
// else {
//   window.location = "http://localhost/dcj%20canteen/User/home.php";
// }
