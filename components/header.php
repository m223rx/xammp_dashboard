<header>
    <div class="headerContainer">
        <img src="http://192.168.1.121/resources/images/logo.png" alt="" onclick="return redirect('#');">
        <div class="navItems">
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="./services/services.php">Services</a></li>
                    <li><a href="http://192.168.1.121/phpmyadmin" target="_blank">PhpMyAdmin</a></li>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        echo '
                                    <li>
                                        <form action="index.php" method="post">
                                            <button type="submit">logout</button>
                                        </form>
                                    </li>
                                ';
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