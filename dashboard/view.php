<?php
if (isset($_GET['file'])) {
    // Get and sanitize the file path
    $filePath = realpath(urldecode($_GET['file']));

    // Check for invalid file paths (avoid directory traversal)
    if ($filePath === false || strpos($filePath, realpath('./')) !== 0) {
        echo "<p>Invalid file path.</p>";
        exit;
    }

    // Check if the file exists
    if (!file_exists($filePath)) {
        echo "<p>The file does not exist.</p>";
        exit;
    }

    // Get file details
    $fileName = basename($filePath);
    $fileType = mime_content_type($filePath);
    $fileIcon = getIcon($filePath);
} else {
    echo "<p>No file specified.</p>";
    exit;
}

// Function to determine file icon
function getIcon($path)
{
    if (is_dir($path)) {
        return 'resources/icons/folder.png';
    }

    $fileType = mime_content_type($path);
    $icons = [
        'text/html' => 'resources/icons/html.png',
        'text/css' => 'resources/icons/css.png',
        'application/javascript' => 'resources/icons/javascript.png',
        'image/png' => 'resources/icons/png.png',
        'image/jpeg' => 'resources/icons/jpeg.png',
        'image/gif' => 'resources/icons/gif.png',
        'application/pdf' => 'resources/icons/pdf.png',
        'text/plain' => 'resources/icons/text.png',
        'text/php' => 'resources/icons/php.png',
        'default' => 'resources/icons/document.png'
    ];

    return isset($icons[$fileType]) ? $icons[$fileType] : $icons['default'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="helpers/controller.js"></script>
    <title>View File - <?php echo $fileName; ?></title>
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
        <div class="file-view-container">
            <h2>Viewing File: <?php echo $fileName; ?></h2>

            <?php
            // For image files, directly output the image
            if (strpos($fileType, 'image') === 0) {
                // Serve the image from the relative path
                $imageUrl = str_replace(realpath('./'), '', $filePath);
                ?>
                <div class="file-content">
                    <img src="<?php echo $imageUrl; ?>" alt="<?php echo $fileName; ?>"
                        style="max-width: 100%; height: auto;">
                </div>
            <?php
                // For PDF files, use embed to display them
            } elseif ($fileType == 'application/pdf') {
                ?>
                <div class="file-content">
                    <embed src="<?php echo str_replace(realpath('./'), '', $filePath); ?>" type="application/pdf"
                        width="100%" height="600px" />
                </div>
            <?php
                // For text or other file types, display the content
            } else {
                ?>
                <div class="file-content">
                    <pre><?php echo htmlspecialchars(file_get_contents($filePath)); ?></pre>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>