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

<?php include "components/navbar.php"; ?> 

<main>
    <section class="banner">
        <div class="container text-white">
            <h1>Portfólio</h1>
        </div>
    </section>
    
    <section class="container">
        <div class="row">
            <?php
            $json_data = file_get_contents("jsons/portfoliodata.json");
            $data = json_decode($json_data);

            $count = 0;
            foreach ($data->websites as $key => $website) {
                // Po každých 4 kartách zobraz nový riadok
                if ($count % 4 == 0 && $count != 0) {
                    echo '</div><div class="row">';
                }
                echo '<div class="col-25 portfolio text-white text-center" id="portfolio-' . ($key + 1) . '">';
                echo '<h3>' . $website->name . '</h3>';
                echo '</div>';
                $count++;
            }
            ?>
        </div>
    </section>   
</main>

<?php include "components/footer.php"; ?>

<script src="js/menu.js"></script>
</body>
</html>
