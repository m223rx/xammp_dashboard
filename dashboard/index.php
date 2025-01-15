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
        <!-- Show all the available files in the root -->
        <div id="fileList" class="file-list">
            <?php
            $dir = './'; // Define the path to your directory
// Check if the directory exists before trying to read it
            if (is_dir($dir)) {
                $files = array_diff(scandir($dir), array('..', '.')); // Get all files excluding '.' and '..'
            
                // Check if there are any files
                if (count($files) == 0) {
                    echo "<p>No files found in the directory.</p>";
                } else {
                    // Loop through files and create a card for each
                    foreach ($files as $file) {
                        $filePath = $dir . '/' . $file;

                        // Check if it's a file (not a directory)
                        if (is_file($filePath)) {
                            $fileType = mime_content_type($filePath); // Get MIME type for each file
                            $fileIcon = getFileIcon($fileType); // Function to get the appropriate file icon
            
                            // Display the file as a card
                            echo "<div class='file-card'>
                        <img src='$fileIcon' alt='File Icon'>
                        <h3>$file</h3>
                        <p>Type: $fileType</p>
                      </div>";
                        }
                    }
                }
            } else {
                echo "<p>The directory '$dir' does not exist.</p>";
            }

            // Function to get the file icon based on the MIME type
            function getFileIcon($mimeType)
            {
                $icons = [
                    'text/html' => 'icons/html-icon.png',
                    'text/css' => 'icons/css-icon.png',
                    'application/javascript' => 'icons/js-icon.png',
                    'image/png' => 'icons/png-icon.png',
                    'application/pdf' => 'icons/pdf-icon.png',
                    'text/plain' => 'icons/text-icon.png', // New MIME type added for text files
                    'default' => 'icons/default-icon.png'
                ];

                // Return the appropriate icon or a default icon if not found
                return isset($icons[$mimeType]) ? $icons[$mimeType] : $icons['default'];
            }
            ?>
        </div>
    </main>
</body>

</html>