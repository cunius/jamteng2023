<?php
session_start();
include 'head.php';
include 'upload.php';

//Redirect no admin
if (!isset($_SESSION['isAdmin'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $userId = $_SESSION['userId'];

    if (!$uploadStatus["error"]) {
        $sql = "INSERT INTO admin (title, content, userId) VALUES ('$title', '$content', '$userId')";

        if ($conn->query($sql) === TRUE) {
            header("Location: adlist.php");
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

<h1>💜 유애나 공지사항 💜</h1>

<form method="post" action="" enctype="multipart/form-data">
    공지<br>
    <input type="text" name="title" id="title" value=""><br><br>
    내용<br>
    <textarea name="content" id="content" rows="15" cols="63"></textarea><br><br>
</form>

<footer><?php include ("footer.php") ?></footer>
