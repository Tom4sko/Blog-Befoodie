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
                // Načítanie a dekódovanie JSON dát
                $navData = json_decode(file_get_contents($jsonFile), true);
                // Overenie, či sa podarilo správne načítať JSON dáta
                if ($navData !== null) {
                    // Počet položiek v navigácii
                    $navCount = count($navData);
                    foreach ($navData as $key => $item) {
                        // Priraďovanie triedy pre aktívne položky
                        $class = ($key >= $navCount - 0) ? 'nav-entry' : '';
                        // Výpis položiek navigácie
                        if ($item['label'] !== 'Login') {
                            echo "<li class='$class'><a href='" . htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') . "</a></li>";
                        }
                    }
                    // Overenie, či je užívateľ prihlásený
                    if (isset($_SESSION['user_name'])) {
                        echo "<li class='nav-entry user-dropdown'>";
                        echo "<a href='#'>" . htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') . "</a>";
                        echo "<ul class='dropdown-menu'>";
                        // Zobrazenie položky "Dashboard" pre admina
                        if ($_SESSION['user_role'] === 'admin') {
                            echo "<li><a href='dashboard.php'>Dashboard</a></li>";
                        }
                        echo "</ul>";
                        echo "</li>";
                        // Položka "Log Out"
                        echo "<li class='nav-entry'><a href='db/logout.php'>Log Out</a></li>";
                    } else {
                        // Položka "Login"
                        echo "<li class='nav-entry'><a href='registerlogin.php'>Login</a></li>";
                    }
                } else {
                    echo "<li class='error'>Chyba: Nepodarilo sa správne spracovať JSON dáta.</li>";
                }
            } else {
                echo "<li class='error'>Chyba: JSON súbor nebol nájdený.</li>";
            }
        ?>
        </ul>

        <a class="hamburger" id="hamburger">
            <i class="fa fa-bars"></i>
        </a>
    </nav>
</header>
