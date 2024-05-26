<?php
    session_start();

    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
        echo 'User is admin.';
    } else {
        echo 'User is not admin.';
    }
?>
