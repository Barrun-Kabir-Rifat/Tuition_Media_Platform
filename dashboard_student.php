<?php
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit;
}

// Include database connection
require 'database.php';

// Fetch user details from the database
$stmt = $conn->prepare("SELECT name, email, class FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
        <nav>
            <ul>
                <li><a href="post_tuition.php">Post Tuition Request</a></li>
                <li><a href="job_board.php">view Job board</a></li>
                <li><a href="teacher_list.php">Find Teachers</a></li>
                <li><a href="application_received.php">View Applications</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Your Profile</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Class:</strong> <?= htmlspecialchars($user['class']) ?></p>
        
        <h2>Actions</h2>
        <p>You can manage your tuition requests and find teachers from the options above.</p>
    </main>
    <br><br><br><br><br>
    <footer>
        <p>&copy; 2025 Tuition Media Platform. All rights reserved.</p>
    </footer>
</body>
</html>