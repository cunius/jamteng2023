<?php
session_start();
include 'head.php';
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// Fetch the post and its author's user_id
$sql = "SELECT userId, title, content FROM bbs WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h2>$id 가 편지 안 써줘떠.. 🙁<h2>";
    exit;
}

$row = $result->fetch_assoc();

// Check if the logged-in user is the author or an admin
if ($_SESSION['userId'] != $row['userId'] && $_SESSION['isAdmin'] != 1) {
    echo "<h2>왜 내 편지 지우려고 해!! 이 나쁜 놈아 🤨</h2>";
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $update_sql = "UPDATE bbs SET title = '$title', content = '$content' WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: list.php");
        exit;
    } else {
        echo "<h2>내 편지를 감히 지울 수 없다!!</h2>" . $conn->error;
    }
}
?>

<form method="post" action="">
    제목<br><input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>"><br><br>
    내용<br>
    <textarea name="content" rows="15" cols="63" id="content"><?php echo htmlspecialchars($row['content']); ?></textarea><br><br>
    <input type="submit" value="Update Post">
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
