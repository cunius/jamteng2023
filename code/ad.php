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

<body>
    <h1>유애나 가입 해 줄꼬징? 헿 💜</h1>
    <h3>💜 유애나 7기 모집 중 💜</h3>
    <h3>💜 가입비 516만원 💜</h3>
    <h3>💜 손 틈새로 비치는 유애나 참! 좋! 다! 💜</h3>
    <img src="iu2.jpg" width="500">


    <footer>
        <?php include ("footer.php") ?>
    </footer>
</body>
</html>
