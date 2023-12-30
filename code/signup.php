<?php
include 'head.php';
include 'config.php'; // Include the configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $conn->real_escape_string($_POST['userName']);
    $userPassword = $conn->real_escape_string($_POST['userPassword']);
    $userEmail = $conn->real_escape_string($_POST['userEmail']);
    $userAddr = $conn->real_escape_string($_POST['userAddr']);
    
    $sql = "INSERT INTO users (userName, userPassword, userEmail, userAddr) VALUES ('$userName', '$userPassword', '$userEmail', '$userAddr')";

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        header("Location: login.php");
    } else {
        $error = "Error: " . $sql;
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<body>

<h2>💜 유애나 가입 신청서 💜</h2>
<form method="post" action="signup.php">
    코드네임<br> <input type="text" name="userName" placeholder="너만의 아이디" required><br>
    비밀번호<br> <input type="password" name="userPassword" placeholder="100자의 조잡한 암호"required><br>
    이메일<br> <input type="email" name="userEmail" placeholder="iu@uaena.com" required><br>
    은신처<br> <input type="text" name="userAddr" placeholder="아이유시 잠탱구 지니로" required><br>
    <input type="submit" value="가입 💜">
</form>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>

</body>
</html>
