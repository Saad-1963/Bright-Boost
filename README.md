# Bright-Boost

Welcome to ShopOnline, a web-based platform or mobile application that simplifies the enrollment process, offers students and tutors a more structured and efficient way to interact, and optimizes program management.
## overview
#### Registration: 
Users can create their accounts, providing necessary personal information, and establish a secure online presence within the platform.

#### Login: 
Registered users can access their accounts by entering their credentials, ensuring a seamless and personalized experience.

#### Enroll Course: 
Students can easily enroll in courses on our platform. To do so, they can use the 'enroll' function, providing the course ID, name, or any required information. This feature allows them to access a world of knowledge and start their educational journey with ease.

#### Ask Question: 
Once enrolled in a course, students have the opportunity to ask questions and seek clarification on course material. They can utilize the 'ask_question' feature to engage with instructors, promoting a collaborative and interactive learning experience.

#### Answer Question: 
Tutors play a vital role in our learning platform. They are committed to providing guidance and support to enrolled students by answering their questions and addressing any concerns. This collaborative learning environment ensures that students receive the help and clarification they need throughout their course journey.

#### Assign course:
Administrators have the capability to assign courses to tutors, enabling effective course management. This feature ensures that each course is overseen by a qualified tutor, fostering a structured and organized learning experience for students.
## SQL Queries


To Store User data 

```bash
  
CREATE TABLE Tutors (
    TutorID SERIAL PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    ExpertiseArea VARCHAR(100) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

-- Create the Students table
CREATE TABLE Students (
    StudentID SERIAL PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    School VARCHAR(100),
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    EnrollmentStatus VARCHAR(20),
    EnrollmentYear INT,
    Term VARCHAR(20)
);

-- Create the Course table
CREATE TABLE Course (
    CourseID SERIAL PRIMARY KEY,
    CourseName VARCHAR(100) NOT NULL,
    TutorID INT REFERENCES Tutors(TutorID)  
);

-- Create the Enrollment table
CREATE TABLE Enrollment (
    EnrollmentID SERIAL PRIMARY KEY,
    StudentID INT REFERENCES Students(StudentID) ON DELETE CASCADE,
    CourseID INT REFERENCES Course(CourseID) ON DELETE CASCADE
);

-- Create the Question table
CREATE TABLE Question (
    QuestionID SERIAL PRIMARY KEY,
    StudentID INT REFERENCES Students(StudentID) ON DELETE CASCADE,
    CourseID INT REFERENCES Course(CourseID) ON DELETE CASCADE,
    QuestionText TEXT NOT NULL,
    Timestamp TIMESTAMP DEFAULT NOW()
);

ALTER TABLE Question
ADD IsAnswered BOOLEAN DEFAULT 0;

-- Create the Answer table
CREATE TABLE Answer (
    AnswerID SERIAL PRIMARY KEY,
    TutorID INT REFERENCES Question(QuestionID),
    QuestionID INT REFERENCES Tutors(TutorID),
    AnswerText TEXT NOT NULL,
    Timestamp TIMESTAMP DEFAULT NOW()
);

CREATE TABLE Admins (
    AdminID SERIAL PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);

INSERT INTO Admins (FirstName, LastName, Email, Password)
VALUES ('abc', 'def', 'abc@abc.com', '12345');


```
## Demo
#### Landing Page

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/9049d94a08815c5f1dc639fb36c8b382bf8271ce/index.JPG)

#### User Registration
Register a new STudent or Tutor account by providing your name, Surname, email address and password.

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/ab7832a0aff45b415ce617a5c50de7e7668c6c6f/registration.JPG)

#### Login
Log in using your email address and password

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/ab7832a0aff45b415ce617a5c50de7e7668c6c6f/login.JPG)

###  Admin
####  Assign Course
After logging in, admin can assign course to tutors.

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/ab7832a0aff45b415ce617a5c50de7e7668c6c6f/admin%20add%20course.JPG)

####  Student
####  Enroll Course
After logging in, student can Enroll in courses.

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/ab7832a0aff45b415ce617a5c50de7e7668c6c6f/course%20enrollment.JPG)


#### Ask Question
Student can ask Question Related to courses he erolled and also see the answers given by tutors.

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/ab7832a0aff45b415ce617a5c50de7e7668c6c6f/ask%20Question.JPG)

####  Tutor
####  Answer Questions
Tutor can answer the question related to his courses.

![App Screenshot](https://github.com/Saad-1963/Bright-Boost/blob/ab7832a0aff45b415ce617a5c50de7e7668c6c6f/answer%20question.JPG)


