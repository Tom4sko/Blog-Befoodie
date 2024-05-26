var accordion = document.getElementsByClassName('accordion');
for(a of accordion){
    a.addEventListener("click",function(){
      this.classList.toggle('active');
    })
  }

  document.addEventListener('DOMContentLoaded', function() {
    console.log('Document loaded');
    var darkModeToggle = document.getElementById('dark-mode-toggle');
    console.log('Button:', darkModeToggle);

    darkModeToggle.addEventListener('click', function() {
        console.log('Button clicked');
        document.body.classList.toggle('dark-theme');
        
        var darkModeEnabled = document.body.classList.contains('dark-theme');
        if (darkModeEnabled) {
            document.cookie = 'darkMode=enabled; expires=Fri, 31 Dec 9999 23:59:59 GMT';
        } else {
            document.cookie = 'darkMode=; expires=Thu, 01 Jan 1970 00:00:00 GMT';
        }
    });
});

