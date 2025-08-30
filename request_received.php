<?php
session_start();

// Check if the user is logged in as a teacher
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher') {
    header("Location: login_teacher.php");
    exit;
}

// Include database connection
require 'database.php';

// Fetch offers received by the teacher
$stmt = $conn->prepare("
    SELECT 
        selections.id, 
        tuitions.subject, 
        tuitions.details, 
        users.name AS student_name 
    FROM 
        selections 
    JOIN 
        users ON selections.student_id = users.id 
    JOIN 
        tuitions ON tuitions.student_id = users.id 
    WHERE 
        selections.teacher_id = ?
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Requests</title>
    <link rel="stylesheet" href="applications.css">
</head>
<body>
    <header>
        <h1>Received Requests</h1>
        <nav>
            <ul>
                <li><a href="dashboard_teacher.php">Dashboard</a></li>
                <li><a href="job_board.php">View Job Board</a></li>
                <li><a href="applications.php">View Applications</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Offers from Students</h2>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Details</th>
                    <th>Student Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['subject']) ?></td>
                            <td><?= htmlspecialchars($row['details']) ?></td>
                            <td><?= htmlspecialchars($row['student_name']) ?></td>
                            <td>
                                <form >
                                    <textarea> contact using gmail </textarea>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No offers received.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2025 Tuition Media Platform. All rights reserved.</p>
    </footer>
</body>
</html>
