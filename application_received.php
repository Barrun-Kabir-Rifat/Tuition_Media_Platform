<?php
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit;
}

// Include database connection
require 'database.php';

// Fetch applications for the tuition posts made by the student
$stmt = $conn->prepare("SELECT applications.id, tuitions.subject, tuitions.details, users.name AS teacher_name 
                         FROM applications 
                         JOIN tuitions ON applications.tuition_id = tuitions.id 
                         JOIN users ON applications.teacher_id = users.id 
                         WHERE tuitions.student_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Applications Received</title>
    <link rel="stylesheet" href="applications.css">
</head>
<body>
    <header>
        <h1>Applications Received</h1>
        <nav>
            <ul>
                <li><a href="dashboard_student.php">Dashboard</a></li>
                <li><a href="job_board.php">View Job Board</a></li>
                <li><a href="teacher_list.php">Find Teachers</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Applications for Your Tuition Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Details</th>
                    <th>Teacher Name</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['subject']) ?></td>
                            <td><?= htmlspecialchars($row['details']) ?></td>
                            <td><?= htmlspecialchars($row['teacher_name']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No applications received.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
   
</body>
</html>