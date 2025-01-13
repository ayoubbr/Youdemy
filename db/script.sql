CREATE DATABASE YoudemyDB;

use YoudemyDB;

CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) UNIQUE,
    description TEXT,
    badge VARCHAR(255) UNIQUE
) ENGINE = INNODB;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(30),
    lastname VARCHAR(30),
    password VARCHAR(50),
    email VARCHAR(50) UNIQUE,
    phone VARCHAR(20) UNIQUE,
    photo VARCHAR(255),
    status VARCHAR(55),
    role_id INT,
    Foreign Key (role_id) REFERENCES roles (id)
) ENGINE = INNODB;

CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) UNIQUE,
    description TEXT
) ENGINE = INNODB;

CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(35) UNIQUE,
    description TEXT
) ENGINE = INNODB;

CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    price FLOAT,
    rating FLOAT,
    content VARCHAR(255),
    categorie_id INT,
    teacher_id INT,
    Foreign Key (categorie_id) REFERENCES categories (id),
    Foreign Key (teacher_id) REFERENCES users (id)
) ENGINE = INNODB;

CREATE TABLE subscriptions (
    course_id INT,
    FOREIGN KEY (course_id) REFERENCES courses (id),
    student_id INT,
    FOREIGN KEY (student_id) REFERENCES users (id),
    PRIMARY KEY (course_id, student_id)
) ENGINE = INNODB;

CREATE TABLE course_tags (
    course_id INT,
    FOREIGN KEY (course_id) REFERENCES courses (id),
    tag_id INT,
    FOREIGN KEY (tag_id) REFERENCES tags (id),
    PRIMARY KEY (course_id, tag_id)
) ENGINE = INNODB;