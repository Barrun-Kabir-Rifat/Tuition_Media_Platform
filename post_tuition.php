<!-- post_tuition.php -->
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login_student.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject = $_POST['subject'];
    $details = $_POST['details'];
    $time = $_POST['time'];
    $salary = $_POST['salary'];
    $student_id = $_SESSION['user_id'];

    require 'database.php';
    $stmt = $conn->prepare("INSERT INTO tuitions (subject, details, time, salary, student_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $subject, $details, $time, $salary, $student_id);
    if ($stmt->execute()) {
        echo "Tuition job posted successfully!";
        exit;
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
    <title>Post Tuition Job</title>
    <link rel="stylesheet" href="signin_signup.css">
</head>
<body>
    <header>
        <h1>Post a Tuition Job</h1>
    </header>
    <main>
        <form method="POST">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" placeholder="Enter subject" required>

            <label for="details">Details</label>
            <br>
            <textarea name="details" id="details" placeholder="Provide detailed requirements" required></textarea>
             <br><br>
            <label for="time">Preferred Time</label>
            <input type="text" name="time" id="time" placeholder="Enter preferred time" required>

            <label for="salary">Proposed Salary</label>
            <input type="text" name="salary" id="salary" placeholder="Enter proposed salary" required>

            <button type="submit">Post Job</button>
        </form>
    </main>
</body>
</html>

