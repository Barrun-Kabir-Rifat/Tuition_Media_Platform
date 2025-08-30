<!-- signup_student.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $address = $_POST['address'];
    $school_college = $_POST['school_college'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    require 'database.php';
    $stmt = $conn->prepare("INSERT INTO users (name, class, address, school_college, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, 'student')");
    $stmt->bind_param("sssssss", $name, $class, $address, $school_college, $email, $phone, $password);
    if ($stmt->execute()) {
        echo "Student registered successfully!";
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
    <title>Student Registration</title>
    <link rel="stylesheet" href="signin_signup.css">
</head>
<body>
    <header class="header">
        <h1>Register as a Student</h1>
    </header>
    <main>
        <form method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>

            <label for="class">Class</label>
            <input type="text" name="class" id="class" placeholder="Enter your class" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" placeholder="Enter your address" required>

            <label for="school_college">School/College Name</label>
            <input type="text" name="school_college" id="school_college" placeholder="Enter your school or college name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>

            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
