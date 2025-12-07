# 🎓 Tuition Media Platform

A simple web-based platform that connects **students** and **teachers** for tuition opportunities.  
This system allows users to register, log in, browse tuition posts, manage applications, and interact through a clean dashboard experience.

---

## 🚀 Features

### 👨‍🎓 Student Features
- Student registration & login  
- Browse available teachers  
- Apply for tuition opportunities  
- View personal dashboard  
- Manage applications  

### 👨‍🏫 Teacher Features
- Teacher registration & login  
- Create & publish tuition posts  
- View student applications  
- Accept or reject tuition requests  
- Manage own tuition posts  

### 🖥️ General Features
- Role-based authentication (Student / Teacher)  
- Clean UI using CSS  
- SQL database integration  
- Session handling & logout system  
- Structured PHP backend  

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| **Frontend** | HTML, CSS |
| **Backend** | PHP |
| **Database** | MySQL (`query.sql`) |
| **Server** | Apache (XAMPP/WAMP/LAMP/MAMP) |

---

## 📁 Project Structure
Tuition_Media_Platform/
│
├── index.php # Homepage
├── signup_student.php # Student registration
├── signup_teacher.php # Teacher registration
├── login_student.php # Student login
├── login_teacher.php # Teacher login
│
├── dashboard_student.php # Student dashboard
├── dashboard_teacher.php # Teacher dashboard
│
├── post_tuition.php # Form for posting tuitions
├── teacher_list.php # List of teachers
├── job_board.php # Tuition job board
├── applications.php # Student applications
├── request_received.php # Teachers view received requests
├── application_received.php # View detailed request
│
├── styles.css # Global CSS file
├── signin_signup.css # Login/signup styles
│
├── database.php # DB connection
├── query.sql # Database structure
│
└── README.md # Documentation

---

## 🛠️ Installation & Setup

### **1️⃣ Clone the repository**

git clone https://github.com/Barrun-Kabir-Rifat/Tuition_Media_Platform.git

---
## 🔮 Future Improvements

- Implement password hashing using `password_hash()` for stronger security  
- Add full form validation (both frontend and backend)  
- Introduce an admin panel to manage users and posts  
- Add search & filtering features for subjects, locations, budget, experience, etc.  
- Improve UI/UX with a modern CSS framework (Bootstrap/Tailwind)  
- Add teacher–student messaging or chat system  
- Implement pagination for teacher lists and job boards  
- Add profile picture upload functionality  
- Make the entire platform mobile-responsive  
- Introduce notifications for tuition requests and approvals  

---

## 🤝 Contributing

Contributions are welcome and appreciated!  
To contribute to this project:

1. **Fork** the repository  
2. **Create** a new feature branch  
   ```bash
   git checkout -b feature-name
   
👤 Author
Barrun Kabir Rifat
GitHub Profile:
