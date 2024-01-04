<?php
include 'head.php';
include 'config.php';

$id = $_GET['id'];
// $id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : 0;


$sql = "SELECT id, title, content, created_at, filePath FROM bbs WHERE id = $id";
// $sql = "SELECT id, title, content FROM bbs WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>".$row["id"].". ".$row["title"]."</h2>";
    echo "<p>".$row["content"]."</p>";
    echo "<p>보낸 날짜는 ".$row["created_at"]." 💜</p>";

    if (!empty($row['filePath'])) {
         $imageUrl = 'getimage.php?url=' . urlencode($row['filePath']);
        echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="Uploaded Image" style="max-width:80%;height:auto;">';
    }
} else {
    echo "<h2>아무도 편지 안 써줘떠... 🥲</h2>";
}
$conn->close();
?>
<body>
    <form method="get" action="list.php">
        <input type="submit" value="목록">
    </form>
    <footer><?php include ("footer.php") ?></footer>
</body>
