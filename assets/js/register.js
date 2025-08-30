const form = document.getElementById("registerForm");
const errorMsg = document.getElementById("errorMsg");

form.addEventListener("submit", function (e) {
  e.preventDefault(); // prevent page reload

  const formData = new FormData(form);
  console.log(formData);
  fetch("./register.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        window.location.href = "login.php";
      } else {
        errorMsg.textContent = data.error;
      }
    })
    .catch((err) => {
      errorMsg.textContent = "Something went wrong. Please try again.";
      console.error(err);
    });
});
