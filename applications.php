<?php
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher') {
    header("Location: login_teacher.php");
    exit;
}

// Include database connection
require 'database.php';

// Fetch applications submitted by the teacher
$stmt = $conn->prepare("SELECT applications.id, tuitions.subject, tuitions.details, tuitions.time, tuitions.salary, users.name AS student_name 
                         FROM applications 
                         JOIN tuitions ON applications.tuition_id = tuitions.id 
                         JOIN users ON tuitions.student_id = users.id 
                         WHERE applications.teacher_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Applications</title>
    <link rel="stylesheet" href="applications.css">
</head>
<body>
    <header>
        <h1>Your Applications</h1>
        <nav>
            <ul>
                <li><a href="dashboard_teacher.php">Dashboard</a></li>
                <li><a href="job_board.php">View Job Board</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Applications List</h2>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Details</th>
                    <th>Time</th>
                    <th>Salary</th>
                    <th>Posted By</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['subject']) ?></td>
                            <td><?= htmlspecialchars($row['details']) ?></td>
                            <td><?= htmlspecialchars($row['time']) ?></td>
                            <td><?= htmlspecialchars($row['salary']) ?></td>
                            <td><?= htmlspecialchars($row['student_name']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No applications found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <br><br><br><br><be>
    <footer>
        <p>&copy; 2025 Tuition Media Platform. All rights reserved.</p>
    </footer>
</body>
</html>
