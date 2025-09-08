const form = document.getElementById("loginForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(form);
  console.log(formData);
  fetch("../ajax/login.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data.success) {
        addAlert("Login Successfully!.<br> Directing to Homepage...", false);
        redirect("index.html");
      } else if (data.error) {
        addAlert(data.error);
      } else if (data.redirect) {
        addAlert(data.error);
        redirect(data.redirect);
      }
    })
    .catch((err) => {
      addAlert("Something went wrong. Please try again.");
      console.error(err);
    });
});
