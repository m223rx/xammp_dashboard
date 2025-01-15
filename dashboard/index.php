<?php
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : './';

$currentDir = realpath($currentDir);
if ($currentDir === false || strpos($currentDir, realpath('./')) !== 0) {
    echo "<p>Invalid directory path.</p>";
    exit;
}

$dirsAndFiles = array_diff(scandir($currentDir), array('..', '.'));

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
        'application/pdf' => 'resources/icons/pdf.png',
        'text/plain' => 'resources/icons/text.png',
        'text/php' => 'resources/icons/php.png',
        'text/py' => 'resources/icons/python.png',
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
    <title>Dashboard</title>
</head>

<body>
    <header>
        <div class="headerContainer">
            <img src="./resources/images/logo.png" alt="" onclick="return redirect('#');">
            <div class="navItems">
                <nav>
                    <ul>
                        <li><a href="/dashboard/">Home</a></li>
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
        <div id="fileList" class="file-list">
            <?php
            if (is_dir($currentDir)) {
                foreach ($dirsAndFiles as $item) {
                    $itemPath = $currentDir . '/' . $item;
                    $encodedPath = urlencode($itemPath);
            
                    if (is_dir($itemPath)) {
                        echo "<a href='?dir=$encodedPath' class='file-card'>
                            <div class='fileCard'>
                                <img src='resources/icons/folder.png' alt='Folder Icon'>
                                <h3>$item</h3>
                                <p>Folder</p>
                              </div></a>";
                    } else {
                        $fileType = mime_content_type($itemPath);
                        $fileIcon = getIcon($itemPath);

                        echo "<a href='view.php?file=$encodedPath' class='file-card'>
                            <div class='fileCard'>
                                <img src='$fileIcon' alt='File Icon'>
                                <h3>$item</h3> 
                                <p>Type: $fileType</p>
                            </div></a>";
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