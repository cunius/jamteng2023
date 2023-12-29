<?php
include 'head.php';
include 'config.php'; // Database connection

$searchTerm = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT id, title, content, created_at FROM posts";
if (!empty($searchTerm)) {
    $sql .= " WHERE title LIKE '%$searchTerm%' OR content LIKE '%$searchTerm%'";
}
$sql .= " ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>BBS Index</title>
    <!-- Your CSS and other head elements here -->
</head>
<body>

<form method="GET" action="index.php">
    <input type="text" name="search" placeholder="아이유를 찾아줘 💜" value="<?php echo htmlspecialchars($searchTerm); ?>">
    <input type="submit" value="Go! 😙">
</form>

<?php
// Display the current search term
if (!empty($searchTerm)) {
    echo "<p>너 <strong>".$searchTerm."</strong> 찾니?</p>";
}

echo "<a href='write.php'>편지 쓰기 💜</a>";

if ($result->num_rows > 0) {
    echo "<table><tr><th>Title</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><a href='read.php?id=".$row["id"]."'>".htmlspecialchars($row["title"])."</a></td>
                <td>
                    <a href='edit.php?id=".$row["id"]."'>Edit</a>
                    <a href='delete.php?id=".$row["id"]."'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "아무도 편지 안 써줘떠... 🥲";
}
$conn->close();
?>

</body>
</html>
