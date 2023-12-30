<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['login_user']);
}

function getUserRole() {
    // Check if 'isAdmin' is set and equals to 1, then return 'Admin', else 'User'
    return (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) ? 'Admin' : 'User';
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>💜 왕잠탱이는 아이유를 조아행 💜</title>
    <!-- Add other head elements like CSS files here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="warp">
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">💜 Home</a></li>
                    <?php if (isLoggedIn()): ?>
                        <li><a href="write.php">💜 게시판</a></li>
                        <a href="logout.php">💜 로그아웃</a><br>
                        <span><h2>💜 환영해 우리 <?php echo htmlspecialchars($_SESSION['login_user']); ?> (<?php echo getUserRole(); ?>) 💜</h2></span>
                    <?php else: ?>
                        <?php if ($current_page == "login.php"): ?>
                            <li><a href="signup.php">💜 7기 가입</a></li>
                        <?php else: ?>
                            <li><a href="login.php">💜 유애나</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul> 
            </nav>
        </header>
    </div>
<br><br><br>

</body>
</html>
