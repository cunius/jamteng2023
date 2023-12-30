<?php
include 'head.php';
session_start();
include 'config.php'; // Include your database configuration file

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $conn->real_escape_string($_POST['userName']);
    $userPassword = $conn->real_escape_string($_POST['userPassword']); // In a real-world scenario, this should be hashed

    $sql = "SELECT id, userName, isAdmin FROM users WHERE userName = '$userName' AND userPassword = '$userPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found
        $row = $result->fetch_assoc();
        $_SESSION['login_user'] = $row['userName']; // Store username in session
        $_SESSION['isAdmin'] = $row['isAdmin']; // Store isAdmin flag in session
        $_SESSION['userId'] = $row['id']; // Assuming $row['id'] is the userId from the database
        
        // Redirect to the index page or another page as needed
        header("Location: index.php");
        exit;
    } else {
        // User not found or password incorrect
        $error = "<h2>☠️ Hello stuPID! Beep! Beep! 해킹하면 너는 혼난다 Beep! Stop it! ☠️</h2>";
    }
}

$conn->close();
?>

<body>
    
    <h1>💜 유애나 입장 💜</h1>
    <form method="post" action="login.php">
        코드네임<br> <input type="text" name="userName" required><br><br>
        암호를 대라<br> <input type="password" name="userPassword" required><br><br>
        <input type="submit" value="입장 💜"">
    </form>
    
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    
    <footer><?php include ("footer.php") ?></footer>
</body>
</html>
