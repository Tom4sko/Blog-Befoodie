<?php
    function generateSlides($dir) {
        // Získanie zoznamu súborov s obrázkami v zadanom adresári
        $files = glob($dir . "/*.jpg");
        
        // Načítanie obsahu JSON súboru obsahujúceho texty pre banner
        $json = file_get_contents("jsons/data.json");
        $data = json_decode($json, true);
        
        // Prechádzanie cez každý obrázok v adresári
        foreach ($files as $file) {
            echo '<div class="slide fade">';
            echo '<img src="' . $file . '">';
            $filename = basename($file);
            
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
