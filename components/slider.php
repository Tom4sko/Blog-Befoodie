<?php
    function generateSlides($dir) {
        $files = glob($dir . "/*.jpg");
        $json = file_get_contents("jsons/data.json");
        $data = json_decode($json, true);
        
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