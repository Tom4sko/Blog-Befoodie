<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja stránka</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  
  <?php
    include "components/navbar.php"
  ?> 

  <main>
    <section>
      <section class="banner">
        <div class="container text-white">
          <h1>Blog</h1>
        </div>
      </section>

        <div class="container">
          <div class="col-100 text-center">
            <p><strong><em>Explore a world of gastronomic delights and culinary inspiration with BeFoodie, where we share delicious recipes, insightful cooking tips, and delightful food stories to satisfy your inner foodie.</em
            ></strong></p>
          </div>
        </div>
    </section>
    
    <section class="container">
      <div class="row">
        <div class="col-50"> 
          <h3>Contributions</h3>
          <p class="zarovnajsa"><span class="uzsomzarovany">↓</span></p> 
        </div>
        <div class="col-50 text-left">
          <h3>Commit To Our Forum</h3>
          <form id="contact" action="db/spracovanieFormulara.php" method="POST" onsubmit="alert('Your post has been succesfully attached!')">
            <input type="text" placeholder="Name of Recept" id="name-of-recept" name="name-of-recept" required><br>
            <input type="text" placeholder="Ingredients" id="ingredients" name="ingredients" required><br>
            <textarea placeholder="Recipe Procedure" id="recipe-procedure" name="recipe-procedure"></textarea><br>
            <div class="form-checkbox">
              <input type="checkbox" name="" id="" required>
              <label for="">Accept of all rules</label><br>
            </div>
            <input type="submit" value="Send">
          </form>
        </div>
      </div>
    </section>

    <section>
      <div class="row blog-wrapper">
        <!-- Tu sa vypise ze co tam byt -->
      </div>
    </section>
  </main>
  
  <?php
    include "components/footer.php"
  ?>

</body>
</html>