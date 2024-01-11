<?php
include 'head.php';
include 'config.php'; // Database connection

$searchTerm = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT id, title, content, created_at FROM admin";
if (!empty($searchTerm)) {
    $sql .= " WHERE title LIKE '%$searchTerm%' OR content LIKE '%$searchTerm%'";
}
$sql .= " ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<body>
<form method="get" action="list.php">
    <input type="text" name="search" placeholder="공지사항 필독 💜" value="<?php echo htmlspecialchars($searchTerm); ?>">
    <input type="submit" value="Go! 😙"
</form><br><br>

<?php
// Display the current search term
if (!empty($searchTerm)) {
    echo "<h2>너 이거 ( <strong>".$searchTerm."</strong> ) 찾니? 왜? 해킹하려구? </h2>";
}


if ($result->num_rows > 0) {
    echo "<table><h1>💜 유애나 공지사항 💜</h1>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
              <td><a href='adread.php?id=".$row["id"]."'>".htmlspecialchars($row["title"])."</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "";
}
$conn->close();
?>
<br><br>
<a href="adlist.php">다른 공지 보러가기 💜</a>
  
<footer><?php include ("footer.php") ?></footer>
