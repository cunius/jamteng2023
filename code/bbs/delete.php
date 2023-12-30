<?php
include 'head.php';
include 'config.php';

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id']; // Get the bbs ID from the URL

//Fetch the post creator's userId
$sql = "SELECT userId FROM bbs WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//Check prm
if ($_SESSION['userId'] != $row['userId'] && $_SESSION['isAdmin'] != 1) {
    echo "Beep! Beep! Dangerous!!";
    exit();
}

//Delete the post
$delete_sql = "DELETE FROM bbs WHERE id = '$id'";
if ($conn->query($delete_sql) === TRUE) {
    echo "Deleted";
    header("Location: list.php");
} else {
    echo "Error!" .$conn->error;
}

?>
