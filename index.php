<?php
require_once 'classes/Directories.php';

$message = "";
$filePath = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $directoryName = trim($_POST['directoryName'] ?? '');
    $content = trim($_POST['content'] ?? '');

    $directories = new Directories();
    $result = $directories->createDirectoryAndFile($directoryName, $content);

    $message = $result['message'];

    if ($result['success']) {
        $filePath = $result['path'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory and File Creator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 500px;
            margin: 30px auto;
        }

        label {
            display: inline-block;
            width: 140px;
            vertical-align: top;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 250px;
        }

        textarea {
            width: 250px;
            height: 120px;
            resize: none;
        }

        .message {
            margin: 15px 0;
            font-weight: bold;
        }

        .link-box {
            margin-bottom: 15px;
        }

        .submit-btn {
            margin-left: 145px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!empty($filePath)): ?>
            <div class="link-box">
                <a href="<?php echo htmlspecialchars($filePath); ?>" target="_blank">
                    Path where the file is located
                </a>
            </div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <p>Enter the folder name and the content of a file.</p>

            <div>
                <label for="directoryName">Folder Name:</label>
                <input type="text" name="directoryName" id="directoryName" required>
            </div>

            <div>
                <label for="content">Content for File:</label>
                <textarea name="content" id="content" required></textarea>
            </div>

            <div class="submit-btn">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>
