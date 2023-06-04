// JavaScript code for the blog

// Function to toggle the navigation menu on smaller screens
function toggleMenu() {
    var nav = document.querySelector('nav');
    nav.classList.toggle('show');
  }
  
  // Add an event listener to the menu icon for toggling the menu
  var menuIcon = document.querySelector('.menu-icon');
  menuIcon.addEventListener('click', toggleMenu);
  