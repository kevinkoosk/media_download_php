<?php
// Function to check if the URL is valid and the file is either MP4 or MP3
function isValidMediaFile($url) {
    // Get headers of the file
    $headers = get_headers($url, 1);
    if ($headers && strpos($headers[0], '200')) {
        $contentType = isset($headers['Content-Type']) ? $headers['Content-Type'] : '';
        // Check if the content type is either video/mp4 or audio/mpeg (MP3)
        return in_array($contentType, ['video/mp4', 'audio/mpeg']);
    }
    return false;
}

// Function to download the media file
function downloadMediaFile($url) {
    // Ensure the download directory exists
    $downloadDir = __DIR__ . '/download';
    if (!is_dir($downloadDir)) {
        mkdir($downloadDir, 0777, true);
    }

    // Generate a unique name for the file
    $fileName = basename(parse_url($url, PHP_URL_PATH));
    $downloadPath = $downloadDir . '/' . $fileName;

    // Download the file
    file_put_contents($downloadPath, fopen($url, 'r'));

    return $downloadPath;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = filter_input(INPUT_POST, 'media_url', FILTER_VALIDATE_URL);

    if ($url && isValidMediaFile($url)) {
        $downloadedFilePath = downloadMediaFile($url);
        $downloadedFileUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/download/' . basename($downloadedFilePath);
        echo "Media file downloaded successfully: <a href=\"$downloadedFileUrl\">$downloadedFileUrl</a>";
    } else {
        echo "Invalid URL or the file is not a valid MP4 or MP3 media file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Media File Downloader</title>
</head>
<body>
    <h1>Download Media File</h1>
    <form method="post" action="">
        <label for="media_url">Media File URL (MP4 or MP3 only):</label>
        <input type="text" id="media_url" name="media_url" required>
        <button type="submit">Download</button>
    </form>
</body>
</html>
