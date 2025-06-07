const searchIcon = document.getElementById('search-icon');
const searchInput = document.getElementById('search-input');

searchIcon.addEventListener('click', () => {
  searchInput.classList.toggle('active');
  if (searchInput.classList.contains('active')) {
    searchInput.focus();
  }
});

const menuToggle = document.getElementById('menu-toggle');
const navbarCenter = document.querySelector('.navbar-center');

menuToggle.addEventListener('click', () => {
  navbarCenter.classList.toggle('show');
});

document.querySelectorAll('.navbar-center a').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth <= 768) {
      navbarCenter.classList.remove('show');
    }
  });
});
