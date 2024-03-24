<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moja stránka</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/portfolio.css">
        <link rel="stylesheet" href="css/banner.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>

        <?php
            include "components/navbar.php"
        ?> 

        <main>
            <section class="banner">
                <div class="container text-white">
                    <h1>Portfólio</h1>
                </div>
            </section>
            
              <section class="container">
                <div class="row">
                  <div class="col-25 portfolio text-white text-center" id="portfolio-1">
                      Web stránka 1
                  </div>
                    <div class="col-25 portfolio text-white text-center" id="portfolio-2">
                        Web stránka 2
                    </div>
                    <div class="col-25 portfolio text-white text-center" id="portfolio-3">
                        Web stránka 3
                    </div>
                    <div class="col-25 portfolio text-white text-center" id="portfolio-4">
                        Web stránka 4
                    </div>
                </div>
                <div class="row">
                    <div class="col-25 portfolio text-white text-center" id="portfolio-5">
                        Web stránka 5
                    </div>
                    <div class="col-25 portfolio text-white text-center" id="portfolio-6">
                        Web stránka 6
                    </div>
                    <div class="col-25 portfolio text-white text-center" id="portfolio-7">
                        Web stránka 7
                    </div>
                    <div class="col-25 portfolio text-white text-center" id="portfolio-8">
                        Web stránka 8
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