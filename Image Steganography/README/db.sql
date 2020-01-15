/* KODA SE DODA SAMA V MYSQL potrebno je samo editirati nastavitve mysql v ./code/installation.php in ./code/functions/db_mysql.php */
CREATE DATABASE IF NOT EXISTS `CP`;
USE 'CP';

CREATE TABLE role (role_id INTEGER PRIMARY KEY AUTO_INCREMENT,rolename VARCHAR(100) NOT NULL);

INSERT INTO role (rolename) VALUES ('admin');
INSERT INTO role (rolename) VALUES ('user');

CREATE TABLE IF NOT EXISTS user (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(100) NOT NULL,
	uname VARCHAR(100) NOT NULL,
	password VARCHAR(1024) NOT NULL,
	salt VARCHAR(100) NOT NULL,
	fname VARCHAR(100) NOT NULL,
	lname VARCHAR(100) NOT NULL,
	role_id INTEGER,
	FOREIGN KEY (role_id) REFERENCES role(role_id)
); 

/* USER and ADMIN */
INSERT INTO user(id, email, uname, password, salt, fname, lname, role_id) values (1, "admin@admin.com", "admin", "a927f17310e78851b3e7f88e40b58a41786d51508a29528247bb3a4934d7b305", "adminSalt", "Admin", "Admin", 1);
INSERT INTO user(id, email, uname, password, salt, fname, lname, role_id) values (2, "user@user.com", "user", "ba1ae0470b250111cd27b7c15dadcc9b19c75c3a8832a9bc907f454e0e87560d", "userSalt", "User", "User", 2);

CREATE TABLE IF NOT EXISTS images (
	image_id INTEGER PRIMARY KEY AUTO_INCREMENT,
	message VARCHAR(300) NOT NULL,
	mode int NOT NULL,
	password VARCHAR(300) NOT NULL,
	user_id INTEGER,
	FOREIGN KEY (user_id) REFERENCES user(id)
);