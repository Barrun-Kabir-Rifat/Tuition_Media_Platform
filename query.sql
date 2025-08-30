-- Create the database 
CREATE DATABASE tuition_platform;

-- Use the created database 
USE tuition_platform;

-- Create the users table 
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    class VARCHAR(50),
    address VARCHAR(255),
    school_college VARCHAR(255),
    degree VARCHAR(100),
    institution VARCHAR(100),
    phone VARCHAR(15),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher') NOT NULL
);

-- Create the tuitions table 
CREATE TABLE tuitions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(100) NOT NULL,
    details TEXT NOT NULL,
    time VARCHAR(100) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    student_id INT,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the applications table
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tuition_id INT,
    teacher_id INT,
    FOREIGN KEY (tuition_id) REFERENCES tuitions(id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the selections table
CREATE TABLE selections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    teacher_id INT,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);