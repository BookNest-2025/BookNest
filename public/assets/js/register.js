const form = document.getElementById("registerForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(form);
  console.log(formData);
  fetch("../ajax/register.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data.success) {
        addAlert(
          "Registerd Successfully!./n Directing to Login page...",
          false
        );
        redirect("login.html");
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
