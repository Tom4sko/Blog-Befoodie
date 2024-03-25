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
          <h3>Any Questions?</h3>
          <p>Have any burning questions about our food blog?</p> 
          <p> Feel free to reach out to us for any inquiries you may have about recipes, cooking techniques.</p>
          <p>We're here to help you navigate the delicious world of BeFoodie!</p>
        </div>
        <div class="col-50 text-right">
          <h3>Contact Us</h3>
          <form id="contact" action="db/spracovanieFormulara.php" method="GET">
            <input type="text" placeholder="Vaše meno" id="meno" name="meno" required><br>
            <input type="email" placeholder="Váš email" id="email" name="email" required><br>
            <textarea placeholder="Vaša správa" id="sprava" name="sprava"></textarea><br>
            <input type="checkbox" name="" id="" required>
            <label for="">Accept of all rules</label><br>
            <input type="submit" value="Send">
          </form>
        </div>
      </div>
    </section>
  </main>
  
  <?php
    include "components/footer.php"
  ?>

  <script src="js/menu.js"></script>
</body>
</html>