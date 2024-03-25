var hamburger  = document.getElementById("hamburger");
function myNav(){
  var menu = document.querySelector(".main-menu");
  /*classList.toggle pridáva a odoberá responsive class na kliknutie.
  Je to to isté, ako keby sme si spravili počítadlo kliknutí a pomocou modulo % 
  by sme pridávali a odoberali class responsive podľa toho, či ide o párne alebo nepárne kliknutie
  */
  menu.classList.toggle("responsive");
}

/*

Spôsob cez addEventListener
hamburger.addEventListener("click", function(){myNav()});
dalo by sa to zapísať aj ako

hamburger.addEventListener("click", myNav);
ale v tomto prípade nevieme passnúť parametre do fukncie 
(v prípade menu nemáme params, v prípade slideru budeme mať)

*/

hamburger.onclick = function() {myNav()};
/* opäť by sa to dalo zapísať ako:
hamburger.onclick = myNav;
*/

// Get the button element
var darkModeToggle = document.getElementById('dark-mode-toggle');

// Add click event listener
darkModeToggle.addEventListener('click', function() {
    // Toggle the dark mode class on the body
    document.body.classList.toggle('dark-theme');
    
    // Check if dark mode is enabled and set a cookie to remember the user's preference
    var darkModeEnabled = document.body.classList.contains('dark-theme');
    if (darkModeEnabled) {
        document.cookie = 'darkMode=enabled; expires=Fri, 31 Dec 9999 23:59:59 GMT';
    } else {
        document.cookie = 'darkMode=; expires=Thu, 01 Jan 1970 00:00:00 GMT';
    }
});

// Check if dark mode is enabled from cookie when the page loads
window.addEventListener('DOMContentLoaded', function() {
    var darkModeCookie = document.cookie.match(/(^|;) ?darkMode=([^;]*)(;|$)/);
    if (darkModeCookie && darkModeCookie[2] === 'enabled') {
        document.body.classList.add('dark-theme');
    }
});
