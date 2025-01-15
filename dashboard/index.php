<?php
// Get the current directory from the URL query parameter (if any)
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : './';

// Ensure the directory path is safe and valid
$currentDir = realpath($currentDir);
if ($currentDir === false || strpos($currentDir, realpath('./')) !== 0) {
    // If the directory is invalid or not inside the root directory
    echo "<p>Invalid directory path.</p>";
    exit;
}

$dirsAndFiles = array_diff(scandir($currentDir), array('..', '.')); // Get files and folders excluding '.' and '..'

// Function to get the file or folder icon
function getIcon($path)
{
    if (is_dir($path)) {
        return 'icons/folder.png'; // Folder icon
    }

    $fileType = mime_content_type($path); // Get MIME type for each file
    $icons = [
        'text/html' => 'icons/html.png',
        'text/css' => 'icons/css.png',
        'application/javascript' => 'icons/javascript.png',
        'image/png' => 'icons/png.png',
        'application/pdf' => 'icons/pdf.png',
        'text/plain' => 'icons/text.png',
        'default' => 'icons/document.png'
    ];

    return isset($icons[$fileType]) ? $icons[$fileType] : $icons['default']; // Default icon for other file types
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="helpers/controller.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <header>
        <div class="headerContainer">
            <img src="./resources/images/logo.png" alt="" onclick="return redirect('#');">
            <div class="navItems">
                <nav>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="localhost/phpmyadmin">PhpMyAdmin</a></li>
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
        <!-- Show all the available files and folders -->
        <div id="fileList" class="file-list">
            <?php
            // Check if the directory exists before trying to read it
            if (is_dir($currentDir)) {
                // Loop through directories and files
                foreach ($dirsAndFiles as $item) {
                    $itemPath = $currentDir . '/' . $item;

                    if (is_dir($itemPath)) {
                        // If it's a folder, display it as a folder card
                        echo "<div class='file-card'>
                                <a href='?dir=" . urlencode($itemPath) . "'>
                                    <img src='icons/folder.png' alt='Folder Icon'>
                                    <h3>$item</h3>
                                    <p>Folder</p>
                                </a>
                              </div>";
                    } else {
                        // If it's a file, display it as a file card
                        $fileType = mime_content_type($itemPath); // Get MIME type for each file
                        $fileIcon = getIcon($itemPath); // Get the appropriate file icon
            
                        echo "<div class='file-card'>
                            <div class='fileCard'>
                                <img src='$fileIcon' alt='File Icon'>
                                <h3>$file</h3>
                                <p>Type: $fileType</p>
                            </div>
                        </div>";
                    }
                }
            } else {
                echo "<p>The directory '$currentDir' does not exist.</p>";
            }
            ?>
        </div>
    </main>
</body>

</html>