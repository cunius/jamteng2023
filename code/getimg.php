<?php
if(isset($_GET['url'])) {
    $url = $_GET['url'];

    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
        die('Invalid URL');
    }
    
    // This is where the SSRF vulnerability is. The script is using a user-provided URL without any validation.
    $content = file_get_contents($url);
    header('Content-Type: image/png');
    echo $content;
}
?>
