<?php
include 'head.php';
include 'config.php';

$id = $_GET['id'];
// $id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : 0;


$sql = "SELECT id, title, content, created_at FROM admin WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>".$row["id"].". ".$row["title"]."</h2>";
    echo "<p>".$row["content"]."</p>";
    echo "<p>".$row["created_at"]." 에 아이유로부터 💜</p>";

} else {
    echo "<h2>아이유 휴가중 🥳</h2>";
}
$conn->close();
?>
<body>
    <form method="get" action="adlist.php">
        <input type="submit" value="목록">
    </form>
    <footer><?php include ("footer.php") ?></footer>
</body>
