<?php
    function pridajPozdrav() {
        $hour = date(format: 'H');
        if ($hour < 12) {
            echo "<h3>Good Morning</h3>";
        } elseif ($hour < 18) {
            echo "<h3>Good Day</h3>";
        } else {
            echo "<h3>Good Evening</h3>";
        }
    }
?>