<?php
include 'head.php';
include 'config.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "UPDATE bbs SET title = '$title', content = '$content' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "편지 고마웡 유애나 💜";
        // Redirect to a confirmation page or back to the post list
        header("Location: index.php");
    } else {
        echo "편지 안 써줄꼬양? 🥺" . $conn->error;
    }
} else {
    // Display edit form
    $id = $_GET['id'];
    $sql = "SELECT title, content FROM bbs WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $content = $row['content'];
    } else {
        echo "너 $id 는 편지를 안 썼어 흥!";
        exit;
    }
}

$conn->close();
?>

<form method="post" action="">
    Title: <input type="text" name="title" id="title" value="<?php echo $title ?? ''; ?>"><br>
    Content:<br>
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
