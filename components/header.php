<?php
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
?>

<header>
    <div class="headerContainer">
        <img src="<?php echo $base_url; ?>/resources/images/logo.png" alt="Logo" onclick="return redirect('#');">
        <div class="navItems">
            <nav>
                <ul>
                    <li><a href="<?php echo $base_url; ?>/index.php">Home</a></li>
                    <li><a href="<?php echo $base_url; ?>/services/services.php">Services</a></li>
                    <li><a href="http://192.168.1.121/phpmyadmin" target="_blank">PhpMyAdmin</a></li>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        echo '
                        <li>
                            <form action="' . htmlspecialchars($base_url) . '/index.php" method="post">
                                <button type="submit">Logout</button>
                            </form>
                        </li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="searchContainer">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </div>
    </div>
</header>