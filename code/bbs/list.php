<?php
include 'head.php';
include 'config.php'; // Database connection

$searchTerm = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT id, title, content, created_at FROM bbs";
if (!empty($searchTerm)) {
    $sql .= " WHERE title LIKE '%$searchTerm%' OR content LIKE '%$searchTerm%'";
}
$sql .= " ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<body>
<form method="get" action="list.php">
    <input type="text" name="search" placeholder="아이유의 편지를 찾아줘 💜" value="<?php echo htmlspecialchars($searchTerm); ?>">
    <input type="submit" value="Go! 😙"
</form><br><br>

<?php
// Display the current search term
if (!empty($searchTerm)) {
    echo "<h2>너 이거 ( <strong>".$searchTerm."</strong> ) 찾니? 왜? 해킹하려구? </h2>";
}


if ($result->num_rows > 0) {
    echo "<table><h1>💜 편지 목록 💜</h1>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
              <td><a href='read.php?id=".$row["id"]."'>".htmlspecialchars($row["title"])."</a></td>
              <td>
                 <a href='edit.php?id=".$row["id"]."'>수정</a>
                 <a href='delete.php?id=".$row["id"]."'>삭제</a>
              </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "";
}
$conn->close();
?>
<br><br>
<a href="write.php">편지쓰러 가기 💜</a>
<footer><?php include ("footer.php") ?></footer>
</body>
</html>
