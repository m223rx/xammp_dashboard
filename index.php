<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /auth/login.php');
    exit;
}

$currentDir = isset($_GET['dir']) ? $_GET['dir'] : './';

$currentDir = realpath($currentDir);
if ($currentDir === false || strpos($currentDir, realpath('./')) !== 0) {
    echo "<p>Invalid directory path.</p>";
    exit;
}

$dirsAndFiles = array_diff(scandir($currentDir), array('..', '.'));

$icons = [
    'jpg' => 'resources/icons/jpeg.png',
    'jpeg' => 'resources/icons/jpeg.png',
    'png' => 'resources/icons/png.png',
    'gif' => 'resources/icons/gif.png',
    'bmp' => 'resources/icons/bmp.png',
    'svg' => 'resources/icons/svg.png',
    'pdf' => 'resources/icons/pdf.png',
    'txt' => 'resources/icons/text.png',
    'html' => 'resources/icons/html.png',
    'css' => 'resources/icons/css.png',
    'js' => 'resources/icons/javascript.png',
    'php' => 'resources/icons/php.png',
    'py' => 'resources/icons/python.png',
    'default' => 'resources/icons/document.png'
];

function getFileExtension($path)
{
    return pathinfo($path, PATHINFO_EXTENSION);
}

function getIcon($path)
{
    global $icons;

    $extension = strtolower(getFileExtension($path));
    return isset($icons[$extension]) ? $icons[$extension] : $icons['default'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['logged_in'] = false;
    header('Location: /auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="./helpers/controller.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <?php
    include('./components/header.php');
    ?>
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

                        echo "<a href='context/view.php?file=$encodedPath' class='file-card'>
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