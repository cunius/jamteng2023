<?php
include 'head.php';
include 'config.php';

$id = $_GET['id']; // Get the bbs ID from the URL

$sql = "DELETE FROM bbs WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Post deleted successfully";
    // Redirect to post list or confirmation page
    header("Location: index.php");
} else {
    echo "Error deleting post: " . $conn->error;
}

$conn->close();
?>
