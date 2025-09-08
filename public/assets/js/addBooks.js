const form = document.getElementById("addBookForm");
const bookPoster = document.getElementById("bookPoster");
const preview = document.getElementById("preview");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(form);
  fetch("../ajax/addBooks.php", {
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

bookPoster.addEventListener("change", () => {
  const file = bookPoster.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      preview.src = reader.result;
      preview.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});
