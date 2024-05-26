var idx = 1;

function show(n) {
  var slides = document.getElementsByClassName("slide");
  if (n > slides.length){
    idx = 1;
  }

  if (n < 1) {
    idx = slides.length;
  }

  for (var i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[idx-1].style.display = "block";  
}

function nextSlide(n) {
  show(idx += n);
}

show(idx);
var prev  = document.getElementById("prev");
prev.addEventListener("click", function(){
    nextSlide(-1)
});

var next  = document.getElementById("next");
next.addEventListener("click", function(){
    nextSlide(1)
});