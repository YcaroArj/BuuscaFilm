const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

document.getElementById('menu-btn').addEventListener('click', function() {
    mobileMenu.classList.toggle('show');
  });