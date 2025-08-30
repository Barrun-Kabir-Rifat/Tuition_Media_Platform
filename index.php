<!-- index.php -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Media Platform</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Tuition Media Platform</h1>
        <nav>
            <ul>
            <li><a href="signup_student.php">Register as Student</a></li>
                <li><a href="signup_teacher.php">Register as Teacher</a></li>
                <li><a href="login_student.php">Student Login</a></li>
                <li><a href="login_teacher.php">Teacher Login</a></li>
            </ul>
        </nav> 
    </header>
    <div class="sidebar">
    <br><br>
    <p>Connecting platform for students and teachers for effective learning.</p>
    <br><br>
    
    <main>
       
        <section>
            <h2>Explore the following things using my website: </h2>
            
                1.Browse teacher profiles by subject.
                <br>
                2.Post tuition requirements.
                <br>
                3.Teachers can apply for tuition jobs.
                <br>
                4.Students can confirm teachers as their requirements.
        </section>
  
    </main>
    
    <br><br><br><br><br><br>
    </div>
    <footer>
        <p>&copy; 2025 Tuition Media Platform. All rights reserved.</p>
    </footer>
</body>
</html>