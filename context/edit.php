<?php

if (isset($_GET['file'])) {
    $filePath = realpath(urldecode($_GET['file']));

    if ($filePath === false || strpos($filePath, realpath('./')) !== 0) {
        echo "<p>Invalid file path.</p>";
        exit;
    }

    if (!file_exists($filePath)) {
        echo "<p>The file does not exist.</p>";
        exit;
    }

    $fileContent = file_get_contents($filePath);
} else {
    echo "<p>No file specified.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['fileContent'];
    if (!empty($newContent)) {
        if (file_put_contents($filePath, $newContent)) {
            echo "<p>File saved successfully!</p>";
        } else {
            echo "<p>Failed to save the file.</p>";
        }
    } else {
        echo "<p>Content cannot be empty.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="./helpers/controller.js"></script>
    <title>Edit File - <?php echo basename($filePath); ?></title>
</head>

<body>
    <header>
        <div class="headerContainer">
            <img src="./resources/images/logo.png" alt="" onclick="return redirect('#');">
            <div class="navItems">
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="localhost/phpmyadmin" target="_blank">PhpMyAdmin</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="searchContainer">
                <input type="text" placeholder="Search...">
                <button type="submit">Search</button>
            </div>
        </div>
    </header>

    <main>
        <div class="file-edit-container">
            <h2>Edit File: <?php echo basename($filePath); ?></h2>

            <form method="post">
                <textarea name="fileContent" rows="20"
                    cols="100"><?php echo htmlspecialchars($fileContent); ?></textarea>
                <br>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </main>
</body>

</html>