<?php
session_start();
include 'config.php';
include 'head.php';

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// Fetch the author's userId
$sql = "SELECT userId FROM bbs WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Check permission
if ($_SESSION['userId'] != $row['userId'] && $_SESSION['isAdmin'] != 1) {
    echo "<h2>너 왜 내 편지 지우려고 해 이 못된 놈아!! 😤</h2>";
    exit;
}

// Delete the post
$delete_sql = "DELETE FROM bbs WHERE id = '$id'";
if ($conn->query($delete_sql) === TRUE) {
    echo "<h2>안녕, 사라진 편지는 내 기억 속에 영원히 저장할게</h2>";
    header("Location: list.php");
} else {
    echo "<h2>삭제는 잔인해 😫</h2> " . $conn->error;
}
?>
