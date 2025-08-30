<!-- login_teacher.php -->
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require 'database.php';
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ? AND role = 'teacher'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'teacher';
            header("Location: dashboard_teacher.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No teacher account found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <link rel="stylesheet" href="signin_signup.css">
</head>
<body>
    <header class="header">
        <h1>Teacher Login</h1>
    </header>
    <main>
        <form method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>

            <?php if (isset($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <button type="submit">Login</button>
            <p>Don't have an account? <a href="signup_teacher.php">Sign up here</a></p>
        </form>

       
    </main>
</body>
</html>
