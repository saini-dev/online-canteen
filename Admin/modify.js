document.querySelectorAll(".showHideBtn").forEach((item) => {
  item.addEventListener("click", (e) => {
    console.log(e.target.getAttribute("name"));
    fetch(
      `http://localhost/dcj%20canteen/Admin/modifier.php?m=${e.target.getAttribute(
        "name"
      )}`
    )
      .then((res) => res.text())
      .then((res) => location.reload());
  });
});
document.querySelector("#logout").addEventListener("click", () => {
  localStorage.removeItem("confirmation");
});
