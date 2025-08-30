<!-- signup_teacher.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $degree = $_POST['degree'];
    $institution = $_POST['institution'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    require 'database.php';
    $stmt = $conn->prepare("INSERT INTO users (name, address, degree, institution, phone, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, 'teacher')");
    $stmt->bind_param("sssssss", $name, $address, $degree, $institution, $phone, $email, $password);
    if ($stmt->execute()) {
        echo "Teacher registered successfully!";
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
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="signin_signup.css">
</head>
<body>
    <header class="header">
        <h1>Register as a Teacher</h1>
    </header>
    <main>
        <form method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" placeholder="Enter your address" required>

            <label for="degree">Degree</label>
            <input type="text" name="degree" id="degree" placeholder="Enter your degree" required>

            <label for="institution">Current Institution</label>
            <input type="text" name="institution" id="institution" placeholder="Enter your current institution" required>

            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>

            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>