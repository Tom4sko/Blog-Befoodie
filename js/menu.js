var hamburger  = document.getElementById("hamburger");
function myNav(){
  var menu = document.querySelector(".main-menu");
  menu.classList.toggle("responsive");
}

hamburger.onclick = function() {myNav()};
var darkModeToggle = document.getElementById('dark-mode-toggle');
darkModeToggle.addEventListener('click', function() {
    document.body.classList.toggle('dark-theme');
});

