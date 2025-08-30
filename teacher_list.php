<!-- teacher_list.php -->
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit;
}

require 'database.php';
$stmt = $conn->prepare("SELECT id, name, address, degree, institution, phone, email FROM users WHERE role = 'teacher'");
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $student_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO selections (student_id, teacher_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $student_id, $teacher_id);
    if ($stmt->execute()) {
        echo "Teacher selected successfully!";
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
    <title>Teacher List</title>
    <link rel="stylesheet" href="applications.css">
</head>
<body>
    <header>
        <h1>Available Teachers</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Degree</th>
                    <th>Institution</th>
                    
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['degree']) ?></td>
                        <td><?= htmlspecialchars($row['institution']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="teacher_id" value="<?= $row['id'] ?>">
                                <button type="submit">Select as Teacher</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

