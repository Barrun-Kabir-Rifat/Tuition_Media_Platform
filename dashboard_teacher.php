<?php
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher') {
    header("Location: login_teacher.php");
    exit;
}

// Include database connection
require 'database.php';

// Fetch user details from the database
$stmt = $conn->prepare("SELECT name, email, phone, degree, institution FROM users WHERE id = ?");
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
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
        <nav>
            <ul>
                <li><a href="job_board.php">View Job Board</a></li>
                <li><a href="applications.php">View Applications</a></li>
                <li><a href="request_received.php">Tution Offer</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Your Profile</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
        <p><strong>Degree:</strong> <?= htmlspecialchars($user['degree']) ?></p>
        <p><strong>Institution:</strong> <?= htmlspecialchars($user['institution']) ?></p>
        
        <h2>Actions</h2>
        <p>You can view job opportunities and manage your applications from the options above.</p>
    </main>
    
</body>
</html>