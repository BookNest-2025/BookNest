const form = document.getElementById("loginForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(form);
  fetch("../ajax/login.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) addAlert(data.message, false);
      if (data.error) addAlert(data.error);
      if (data.redirect) redirect(data.redirect);
    })
    .catch((err) => {
      addAlert("Something went wrong. Please try again.");
    });
});
