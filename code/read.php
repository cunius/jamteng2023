<?php
include 'head.php';
include 'config.php';

$id = $_GET['id'];
// $id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : 0;


$sql = "SELECT title, content, created_at FROM posts WHERE id = $id";
// $sql = "SELECT id, title, content FROM posts WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>".$row["id"].". ".$row["title"]."</h1>";
    echo "<p>".$row["content"]."</p>";
    echo "<p>보낸 날짜는 ".$row["created_at"]."</p>";
} else {
    echo "아무도 편지 안 써줘떠... 🥲";
}
$conn->close();
?>
