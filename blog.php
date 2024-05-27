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
  
<?php include "components/navbar.php"; ?> 

<main>
    <?php
      session_start();
      if (isset($_SESSION['user_id'])):
    ?>

    <section class="container">
        <div class="row">
            <div class="col-50"> 
                <h3>Contributions</h3>
                <p class="zarovnajsa"><span class="uzsomzarovany">↓</span></p> 
            </div>
            <div class="col-50 text-left">
                <h3>Commit To Our Forum</h3>
                <form id="contact" action="db/form_processing.php" method="POST" onsubmit="alert('Your post has been successfully attached!')">
                    <input type="text" placeholder="Názov receptu" id="name" name="name" required><br>
                    <input type="text" placeholder="Ingrediencie" id="ingredients" name="ingredients" required><br>
                    <textarea placeholder="Popis receptu" id="description" name="description" required></textarea><br>
                    <div class="form-checkbox">
                        <input type="checkbox" name="accept" id="accept" required>
                        <label for="accept">Accept all rules</label><br>
                    </div>
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section>
        <div class="row blog-wrapper">
            <?php include_once 'db/form_write.php'; ?>
        </div>
    </section>
</main>
  
<?php include "components/footer.php"; ?>

</body>
</html>
