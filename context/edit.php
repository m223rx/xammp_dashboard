<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../auth/login.php');
    exit;
}

$baseDir = realpath('../');

if (isset($_GET['file'])) {
    $filePath = realpath(urldecode($_GET['file']));

    if ($filePath === false || strpos($filePath, $baseDir) !== 0) {
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
    $newContent = $_POST['fileContent'] ?? '';

    if (!empty($newContent)) {
        if (file_put_contents($filePath, $newContent) !== false) {
            $fileContent = $newContent;

            // JavaScript for SweetAlert is printed here
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        title: 'Changes Saved',
                        text: 'Your changes have been saved successfully.',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'View File'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'view.php?file=" . urlencode($filePath) . "';
                        }
                    });
                </script>
            ";
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
    <title>Edit File - <?php echo htmlspecialchars(basename($filePath)); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('../components/header.php'); ?>

    <main>
        <div class="file-edit-container">
            <h2>Edit File: <?php echo htmlspecialchars(basename($filePath)); ?></h2>

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