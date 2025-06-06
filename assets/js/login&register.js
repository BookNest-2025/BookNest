const passBtn = document.getElementById("passBtn");
const passIn = document.getElementById("passIn");

const toggleView = () => {
  if (passIn.getAttribute("type") === "password") {
    passIn.setAttribute("type", "text");
    passBtn.innerHTML = `<i class="bx bxs-eye"></i>`;
  } else {
    passIn.setAttribute("type", "password");
    passBtn.innerHTML = `<i class="bx bxs-eye-slash"></i>`;
  }
};
