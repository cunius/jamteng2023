<?php
include 'head.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<!-- <form method="post" action="write.php">
    Title: <input type="text" name="title"><br>
    Content:<br>
    <textarea name="content"></textarea><br>
    <input type="submit" value="Submit">
</form> -->

<form method="post" action="write.php">
    제목<br><input type="text" name="title" id="title" value="<?php echo $title ?? ''; ?>"><br>
    편지<br>
    <textarea name="content" id="content"><?php echo $content ?? ''; ?></textarea><br>
    <input type="submit" value="전송 💜">
</form>

<h3>💜 팬 래터 💜</h3>
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
