<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    <?php
      include "components/navbar.php"
    ?>    

    <main>
      <section class="slides-container">
        <?php
            include_once "assets/functions.php";
            generateSlides(dir: "img/banner");
          ?>
        
        <a id="prev" class="prev">❮</a>
        <a id="next" class="next">❯</a>
      </section>
      
      <section class="container">
        <div class="row">
          <div class="col-100 text-center">
              <p><strong><em>Explore a world of gastronomic delights and culinary inspiration with BeFoodie, where we share delicious recipes, insightful cooking tips, and delightful food stories to satisfy your inner foodie.</em></strong></p>
          </div>
        </div>
      </section>

      <section class="container">
        <div class="row">
          <div class="col-50">
            <h2>Savoring flavors, sharing stories, celebrating culinary passions.</h2>
          </div>
          <div class="col-50">
            <?php
              include_once "assets/functions.php";
              pridajPozdrav();
            ?>
            <p>Welcome to BeFoodie, where passion meets palate! Dive into a world of culinary delights and gastronomic adventures. Whether you're a seasoned chef or a kitchen novice, our collection of tantalizing recipes, cooking tips, and food stories will satisfy your cravings and inspire your culinary creativity. Join us on this flavorful journey as we explore the art of cooking and the joy of sharing delicious meals with loved ones. Let's embark on a mouthwatering adventure together!.</p>
            <p>Discover the essence of food through our lens – where every dish tells a story, every flavor evokes a memory, and every meal is an opportunity to create unforgettable moments. At BeFoodie, we're not just about recipes; we're about fostering a community united by a love for all things food. Whether you're seeking kitchen inspiration, culinary guidance, or simply a place to connect with fellow food enthusiasts, you've found your home here. Let's savor the journey together, one bite at a time.</p>
          </div>
        </div>
      </section>
    </main>
    
    <?php
      include "components/footer.php"
    ?>

    <script src="js/menu.js"></script>
    <script src="js/slider.js"></script>
</body>
</html>