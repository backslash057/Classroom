CREATE TABLE IF NOT EXISTS Users(
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(50) UNIQUE NOT NULL,
  phone VARCHAR(20) UNIQUE NOT NULL,
  names VARCHAR(100) NOT NULL,
  surnames VARCHAR(100) DEFAULT NULL,
  gender ENUM('M', 'F') DEFAULT NULL,
  birth_date DATE DEFAULT NULL,
  join_date DATE DEFAULT CURRENT_TIMESTAMP,
  role ENUM("STUDENT", "TEACHER") DEFAULT "STUDENT",
  password VARCHAR(256) NOT NULL
);

CREATE TABLE IF NOT EXISTS Course(
  course_id INT PRIMARY KEY AUTO_INCREMENT,
  creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(30) NOT NULL, 
  description VARCHAR(100) DEFAULT "",
  code CHAR(6) NOT NULL
);


CREATE TABLE IF NOT EXISTS Message(
  message_id INT PRIMARY KEY AUTO_INCREMENT,
  content TEXT NOT NULL,
  send_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  course_id INT NOT NULL,
  mention INT DEFAULT NULL, -- can be NULL because message deleted or no mention
  sender_id INT, -- can be NULL because user can be deleted
  deleted BOOLEAN  DEFAULT FALSE,
  CONSTRAINT FOREIGN KEY (sender_id) REFERENCES Users(user_id)
);


CREATE TABLE IF NOT EXISTS Course_inscription(
  course_inscription_id INT PRIMARY KEY AUTO_INCREMENT,
  course_id INT NOT NULL,
  user_id INT NOT NULL,
  inscription_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course(course_id),
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE IF NOT EXISTS Form(
  form_id INT PRIMARY KEY AUTO_INCREMENT,
  description VARCHAR(250),
  data_path VARCHAR(100) NOT NULL -- file to the associated json file
);

CREATE TABLE IF NOT EXISTS Assesment(
  assesment_id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL,
  creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  start_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  deadline DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  course_id INT NOT NULL,
  form_id INT NOT NULL,
  CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course(course_id),
  CONSTRAINT FOREIGN KEY (form_id) REFERENCES Form(form_id)
);

CREATE TABLE IF NOT EXISTS Assignment (
  assignment_id INT PRIMARY KEY AUTO_INCREMENT,
  creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  course_id INT NOT NULL,
  form_id INT NOT NULL,
  CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course(course_id),
  CONSTRAINT FOREIGN KEY (form_id) REFERENCES Form(form_id)
);

CREATE TABLE IF NOT EXISTS Response (
  response_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  form_id INT NOT NULL,
  data_path VARCHAR(100) NOT NULL,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES Users(user_id),
  CONSTRAINT FOREIGN KEY (form_id) REFERENCES Form(form_id)
);

CREATE TABLE IF NOT EXISTS Book(
  book_id INT PRIMARY KEY AUTO_INCREMENT,
  course_id INT,
  file_path VARCHAR(30) NOT NULL
);
