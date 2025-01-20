# Youdemy: Online Learning Platform 🎓📚✨

Youdemy is an interactive online learning platform designed to provide a personalized educational experience for students and teachers. This project emphasizes modularity, scalability, and adherence to object-oriented programming (OOP) principles. 🌟

---

## Table of Contents 📖

1. [Project Overview](#project-overview)
2. [Features](#features)
   - [Front Office](#front-office)
   - [Back Office](#back-office)
   - [Transversal Features](#transversal-features)
3. [Technical Requirements](#technical-requirements)
4. [Database Schema](#database-schema)
5. [UML Diagrams](#uml-diagrams)
6. [Security Considerations](#security-considerations)

---

## Project Overview 🌍

Youdemy aims to revolutionize e-learning by offering a robust system for course creation, enrollment, and management. It facilitates role-specific functionalities for visitors, students, teachers, and administrators, ensuring a streamlined user experience. 💡

---

## Features 🚀

### Front Office 🏫

#### Visitor 👀

- Access the course catalog with pagination.
- Search courses by keywords.
- Create an account with role selection (Student or Teacher).

#### Student 🎓

- View the course catalog.
- Search and view course details (description, content, teacher, etc.).
- Enroll in courses (post-authentication).
- Access a personalized “My Courses” section.

#### Teacher 👩‍🏫

- Add new courses with details such as:
  - Title
  - Description
  - Content (video/text)
  - Tags and category
- Manage courses:
  - Edit, delete, and view enrollments.
- Access course statistics:
  - Number of enrolled students.
  - Number of courses.

### Back Office 🖥️

#### Administrator 🔧

- Validate teacher accounts.
- Manage users:
  - Activate, suspend, or delete accounts.
- Manage content:
  - Courses, categories, and tags.
  - Bulk insertion of tags.
- Access global statistics:
  - Total courses.
  - Distribution by category.
  - Most popular course (by student enrollment).
  - Top 3 teachers (by performance).

### Transversal Features 🌐

- Many-to-Many relationship for courses and tags.
- Polymorphic methods for adding and displaying courses.
- Authentication and role-based authorization for secure route access.
- Role-specific access control.

---

## Technical Requirements 🛠️

- Object-Oriented Programming principles:
  - Encapsulation
  - Inheritance
  - Polymorphism
- Relational database with relationships:
  - One-to-Many
  - Many-to-Many
- User session management with PHP.
- Client-side validation using HTML5 and native JavaScript.
- Server-side validation for:
  - Cross-Site Scripting (XSS).
  - Cross-Site Request Forgery (CSRF).
- Use prepared statements to prevent SQL injection. 🔐

---

## Database Schema 📊

The database schema includes tables for users, courses, tags, and their relationships. A detailed schema diagram is included in the UML section. 🖼️

---

## UML Diagrams 📝

### Use Case Diagram 🖌️

![use case youdemy](https://github.com/user-attachments/assets/145588c7-ca5b-4bbd-baf8-15b447092e38)


### Class Diagram 🧩

![class diagram youdemy_page-0001](https://github.com/user-attachments/assets/f20e9c03-a6e9-471f-9d22-9f670dade0d5)


---

## Security Considerations 🛡️

- **Data Validation:**
  - Client-side validation to minimize errors.
  - Server-side validation to sanitize inputs and prevent XSS/CSRF attacks.
- **SQL Injection Prevention:**
  - Use prepared statements for all database interactions.
- **Session Management:**
  - Secure session handling to prevent unauthorized access.

---

## Conclusion 🎉

This project combines cutting-edge technologies and OOP best practices to create a scalable, secure, and user-friendly online learning platform. With robust role management, comprehensive features, and meticulous attention to detail, Youdemy sets a strong foundation for the future of e-learning. 🚀

