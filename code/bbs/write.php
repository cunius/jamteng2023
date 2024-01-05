<?php
session_start();
include 'head.php';
include 'upload.php';

//Redirect if not logged in
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $userId = $_SESSION['userId'];

    $uploadStatus = handleFileUpload();
    if (!$uploadStatus["error"]) {
        $filePath = $conn->real_escape_string($uploadStatus["filePath"]);

        $sql = "INSERT INTO bbs (title, content, userId, filePath) VALUES ('$title', '$content', '$userId', '$filePath')";

        if ($conn->query($sql) === TRUE) {
            header("Location: list.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo $uploadStatus["errorMessage"];
    }

    $conn->close();
}
?>

<h1>💜 익명의 팬 래터 💜</h1>
<a href="list.php">💜 편지함으로 슝~ 이동!</a><br><br>
<img src="iu4.jpg" width="500"><br>

<form method="post" action="" enctype="multipart/form-data">
    제목<br>
    <input type="text" name="title" id="title" value=""><br><br>
    편지<br>
    <textarea name="content" id="content" rows="15" cols="63"></textarea><br><br>
    우리들의 사진 찰캌!<br>
    <input type="file" id="filePath" name="fileUpload"><br><br>
    <input type="submit" value="편지 전송 💜">
</form>

<div id="preview"></div>

<script>
    function updatePreview() {
        var title = document.getElementById('title').value;
        var content = document.getElementById('content').value;
        document.getElementById('preview').innerHTML = '<h2>' + title + '</h2><p>' + content + '</p>';
    }

    document.getElementById('title').addEventListener('input', updatePreview);
    document.getElementById('content').addEventListener('input', updatePreview);
</script>
<footer><?php include ("footer.php") ?></footer>
