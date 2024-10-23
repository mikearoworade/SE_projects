-- DROP DATABASE IF EXISTS twilight;

-- CREATE DATABASE twilight;

-- GRANT ALL PRIVILEGES ON twilight.* TO 'vast'@'localhost';
-- FLUSH PRIVILEGES;

-- USE twilight;

START TRANSACTION;

CREATE TABLE subjects (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	menu_name VARCHAR(50),
	position INT(3),
	visible TINYINT(1)
);

INSERT INTO subjects VALUES (1, 'About Twilight', 1, 1), (2, 'Consumer', 2, 1), (3, 'Small Business', 3, 0), (5, 'Commercial', 4, 1);

CREATE TABLE pages (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	subject_id INT(10),
	menu_name VARCHAR(50),
	position INT(3),
	visible TINYINT(1),
	content TEXT,
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);


CREATE TABLE admins (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(100),
	last_name VARCHAR(100),
	email VARCHAR(100),
	username VARCHAR(100),
	hashed_password VARCHAR(255)
);

COMMIT;