<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../auth/login.php');
    exit;
}

if (isset($_GET['file'])) {
    $filePath = realpath(urldecode($_GET['file']));

    $baseDir = realpath('../');
    if ($filePath === false || strpos($filePath, $baseDir) !== 0) {
        echo "<p>Invalid file path.</p>";
        exit;
    }

    if (!file_exists($filePath)) {
        echo "<p>The file does not exist.</p>";
        exit;
    }

    $fileName = basename($filePath);
    $fileType = mime_content_type($filePath);
    $fileIcon = getIcon($filePath);
} else {
    echo "<p>No file specified.</p>";
    exit;
}

function getIcon($path)
{
    if (is_dir($path)) {
        return './resources/icons/folder.png';
    }

    $fileType = mime_content_type($path);
    $icons = [
        'text/html' => './resources/icons/html.png',
        'text/css' => './resources/icons/css.png',
        'application/javascript' => './resources/icons/javascript.png',
        'image/png' => './resources/icons/png.png',
        'image/jpeg' => './resources/icons/jpeg.png',
        'image/gif' => './resources/icons/gif.png',
        'application/pdf' => './resources/icons/pdf.png',
        'text/plain' => './resources/icons/text.png',
        'text/php' => './resources/icons/php.png',
        'default' => './resources/icons/document.png'
    ];

    return isset($icons[$fileType]) ? $icons[$fileType] : $icons['default'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="../helpers/controller.js"></script>
    <title>View File - <?php echo htmlspecialchars($fileName); ?></title>
</head>

<body>
    <?php include('../components/header.php'); ?>

    <main>
        <div class="file-view-container">
            <div class="operationContainer">
                <h2>Viewing File: <?php echo htmlspecialchars($fileName); ?> </h2>
                <a href="edit.php?file=<?php echo urlencode($filePath); ?>">Edit File</a>
            </div>

            <?php
            // Display file content
            if (strpos($fileType, 'image') === 0) {
                $imageUrl = str_replace(realpath('../'), '', $filePath);
                ?>
                <div class="file-content">
                    <img src="<?php echo $imageUrl; ?>" alt="<?php echo htmlspecialchars($fileName); ?>"
                        style="max-width: 100%; height: auto;">
                </div>
                <?php
            } elseif ($fileType == 'application/pdf') {
                ?>
                <div class="file-content">
                    <embed src="<?php echo str_replace(realpath('../'), '', $filePath); ?>" type="application/pdf"
                        width="100%" height="600px" />
                </div>
                <?php
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