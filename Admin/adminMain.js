if (localStorage.getItem("confirmation")) {
} else {
  window.location = "http://localhost/dcj%20canteen/Admin/adminLogin.php";
}
document.querySelector("#logout").addEventListener("click", () => {
  localStorage.removeItem("confirmation");
});
