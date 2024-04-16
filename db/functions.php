<?php

function pridajPozdrav() {
    $hour = date(format: 'H'); // date_default_timezone_set()

    if ($hour < 12) {
        echo "<h3>Good Morning</h3>";
    } elseif ($hour < 18) {
        echo "<h3>Good Day</h3>";
    } else {
        echo "<h3>Good Evening</h3>";
    }
}


function generateSlides($dir) {
    $files = glob($dir . "/*.jpg");
    $json = file_get_contents("database/data.json");
    $data = json_decode($json, true);
    
    foreach ($files as $file) {
        echo '<div class="slide fade">';
        echo '<img src="' . $file . '">';
        $filename = basename($file);
        // Získání textu k danému banneru
        if (isset($data["banner"][$filename])) {
            echo '<div class="slide-text">';
            echo $data["banner"][$filename];
            echo '</div>';
        } else {
            echo '<div class="slide-text">No text available for this banner</div>';
        }
        echo '</div>';
    }
}



?>