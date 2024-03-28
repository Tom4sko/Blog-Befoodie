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




// vedel som to spravit len cez ciste
// CSS :has(), :is(), :not(), ale to by bolo viac neprehladne, takze JS je spravna cesta
// Nacitanie buttona cez IDcko
var darkModeToggle = document.getElementById('dark-mode-toggle');

// funkcia, ak sa klikne na tlacitko tak sprav nieco
darkModeToggle.addEventListener('click', function() {
    // co sa stane, cize pridaj do <body> dark-theme ktora je v css uz vytvorena
    document.body.classList.toggle('dark-theme');
});

