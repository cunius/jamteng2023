<?php
include 'head.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<h1>💜 익명의 팬 래터 💜</h1>
<img src="iu4.jpg" width="500">

<form method="post" action="">
    제목<br><input type="text" name="title" id="title" value="<?php echo $title ?? ''; ?>"><br>
    편지<br>
    <textarea name="content" id="content"><?php echo $content ?? ''; ?></textarea><br>
    <input type="submit" value="전송 💜">
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
