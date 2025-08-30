<!-- job_board.php -->
<?php
session_start();
require 'database.php';

$stmt = $conn->prepare("SELECT tuitions.id, tuitions.subject, tuitions.details, tuitions.time, tuitions.salary, users.name AS student_name FROM tuitions JOIN users ON tuitions.student_id = users.id");
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tuition_id = $_POST['tuition_id'];
    $teacher_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO applications (tuition_id, teacher_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $tuition_id, $teacher_id);
    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board</title>
    <link rel="stylesheet" href="applications.css">
</head>
<body>
    <header>
        <h1>Tuition Job Board</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Details</th>
                    <th>Time</th>
                    <th>Salary</th>
                    <th>Posted By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['subject']) ?></td>
                        <td><?= htmlspecialchars($row['details']) ?></td>
                        <td><?= htmlspecialchars($row['time']) ?></td>
                        <td><?= htmlspecialchars($row['salary']) ?></td>
                        <td><?= htmlspecialchars($row['student_name']) ?></td>
                        <td>
                            <?php if ($_SESSION['role'] == 'teacher'): ?>
                                <form method="POST">
                                    <input type="hidden" name="tuition_id" value="<?= $row['id'] ?>">
                                    <button type="submit">Apply</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
