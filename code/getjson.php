<?php
if(isset($_GET['url'])) {
    $url = $_GET['url'];
    // This is where the SSRF vulnerability is. The script is using a user-provided URL without any validation.
    $content = file_get_contents($url);
    header('Content-Type: application/json');
    echo $content;
}
?>
