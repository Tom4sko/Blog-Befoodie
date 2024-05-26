<header class="container main-header">
    <div>
        <a href="index.php">
            <img src="img/logo.png" height="40">
        </a>
    </div>
    <nav class="main-nav">
        <ul class="main-menu" id="main-menu">
        <?php
            session_start();
            $jsonFile = 'jsons/navbardata.json';
            if (file_exists($jsonFile)) {
                $navData = json_decode(file_get_contents($jsonFile), true);
                if ($navData !== null) {
                    $navCount = count($navData);
                    foreach ($navData as $key => $item) {
                        $class = ($key >= $navCount - 0) ? 'nav-entry' : '';
                        if ($item['label'] !== 'Login') {
                            echo "<li class='$class'><a href='" . htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') . "</a></li>";
                        }
                    }
                    if (isset($_SESSION['user_name'])) {
                        echo "<li class='nav-entry user-dropdown'>";
                        echo "<a href='#'>" . htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') . "</a>";
                        echo "<ul class='dropdown-menu'>";
                        if ($_SESSION['user_role'] === 'admin') {
                            echo "<li><a href='dashboard.php'>Dashboard</a></li>";
                        }
                        echo "</ul>";
                        echo "</li>";
                        echo "<li class='nav-entry'><a href='db/logout.php'>Log Out</a></li>";
                    } else {
                        echo "<li class='nav-entry'><a href='registerlogin.php'>Login</a></li>";
                    }
                } else {
                    echo "<li class='error'>Error: Unable to parse JSON data.</li>";
                }
            } else {
                echo "<li class='error'>Error: JSON file not found.</li>";
            }
        ?>
        </ul>
        <a class="hamburger" id="hamburger">
            <i class="fa fa-bars"></i>
        </a>
    </nav>
</header>
