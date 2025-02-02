CREATE TABLE IF NOT EXISTS ClassroomUser(
  user_id INT PRIMARY KEY,
  email VARCHAR(50),
  names VARCHAR(100) NOT NULL,
  surnames VARCHAR(100) NOT NULL,
  gender CHAR(1) NOT NULL,
  password VARCHAR(256) NOT NULL
);

CREATE TABLE IF NOT EXISTS Course(
  course_id INT PRIMARY KEY,
  creator_id INT NOT NULL,
  creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(30) NOT NULL, 
  description VARCHAR(100) DEFAULT NULL,
  code CHAR(5) NOT NULL,
  CONSTRAINT FOREIGN KEY (creator_id) REFERENCES ClassroomUser(user_id)
);

CREATE TABLE IF NOT EXISTS Chat(
  chat_id INT PRIMARY KEY,
  title VARCHAR(30) NOT NULL,
  creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  creator_id INT NOT NULL,
  course_id INT NOT NULL,
  CONSTRAINT FOREIGN KEY (creator_id) REFERENCES ClassroomUser(user_id),
  CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course(course_id)
);

CREATE TABLE IF NOT EXISTS Chat_join(
  chat_join_id INT PRIMARY KEY,
  chat_id INT NOT NULL,
  user_id INT NOT NULL,
  join_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES ClassroomUser(user_id)
);


CREATE TABLE IF NOT EXISTS Message(
  message_id INT PRIMARY KEY,
  contenu TEXT NOT NULL,
  heure_envoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  chat_id INT NOT NULL,
  mentionned INT DEFAULT NULL, # can be NULL because message deleted
  sender_id INT, # can be NULL because user can be deleted
  CONSTRAINT FOREIGN KEY (chat_id) REFERENCES Chat(chat_id)
);


CREATE TABLE IF NOT EXISTS Course_inscription(
  course_inscription_id INT PRIMARY KEY,
  course_id INT NOT NULL,
  user_id INT NOT NULL,
  inscription_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course(course_id),
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES ClassroomUser(user_id)
);

CREATE TABLE IF NOT EXISTS Form(
  form_id INT PRIMARY KEY,
  description VARCHAR(250),
  data_path VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS Assesment(
  assesment_id INT PRIMARY KEY,
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
  assignment_id INT PRIMARY KEY,
  creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  course_id INT NOT NULL,
  form_id INT NOT NULL,
  CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course(course_id),
  CONSTRAINT FOREIGN KEY (form_id) REFERENCES Form(form_id)
);

CREATE TABLE IF NOT EXISTS Response (
  response_id INT PRIMARY KEY,
  user_id INT NOT NULL,
  form_id INT NOT NULL,
  data_path VARCHAR(100) NOT NULL,
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES ClassroomUser(user_id),
  CONSTRAINT FOREIGN KEY (form_id) REFERENCES Form(form_id)
);

CREATE TABLE IF NOT EXISTS Book(
  book_id INT PRIMARY KEY,
  course_id INT,
  file_path VARCHAR(30) NOT NULL
);
