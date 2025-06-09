document.addEventListener('DOMContentLoaded', () => {
  const searchIcon = document.getElementById('search-icon');
  const searchPanel = document.getElementById('search-panel');
  const searchInputField = document.getElementById('search-input-field');

  searchIcon.addEventListener('click', () => {
    searchPanel.classList.toggle('active');

    if (searchPanel.classList.contains('active')) {
      searchInputField.focus();
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
});
