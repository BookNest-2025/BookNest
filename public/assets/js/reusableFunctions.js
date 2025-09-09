const alertMsg = document.querySelector(".alert");

const addAlert = (msg, err = true) => {
  alertMsg.style.backgroundColor = err
    ? "rgba(255, 0, 0, 0.8)"
    : "rgba(0, 163, 0, 0.8)";
  alertMsg.classList.add("active");
  alertMsg.innerHTML = `<p class="alert-message">${msg}</p>`;
  setTimeout(() => {
    alertMsg.classList.remove("active");
  }, 3000);
};

const redirect = (location, time = 2000) => {
  setTimeout(() => {
    window.location.href = location;
  }, time);
};

const logout = () => {
  fetch("../ajax/logout.php", { method: "POST" })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        addAlert(data.message, false);
        redirect(data.redirect);
      }
    })
    .catch((err) => console.error("Logout failed:", err));
};
