-- USER INFO table 
CREATE TABLE users_info (
    student_id INT(10) AUTO_INCREMENT PRIMARY KEY,
    student_email VARCHAR(150) NOT NULL,
    first_name VARCHAR(150) NOT NULL,
    last_name VARCHAR(150)NOT NULL,
    dob DATE NOT NULL
) AUTO_INCREMENT = 100100;

-- users_program 
CREATE TABLE users_program (
    student_id INT(10),
    Program VARCHAR(50)NOT NULL,
    PRIMARY KEY (student_id),
    FOREIGN KEY (student_id) REFERENCES users_info(student_id)
);

-- users avatar
CREATE TABLE users_avatar(
    student_id INT(10) PRIMARY KEY,
 	avatar INT(1) NULL,
    FOREIGN KEY(student_id) REFERENCES users_info(student_id)
);
-- users_address
CREATE TABLE users_address(
	student_id INT(10) PRIMARY KEY,
    street_number INT(5) NULL,
    street_name VARCHAR(150) NULL,
    city VARCHAR(30) NULL,
    province VARCHAR(2) NULL,
    postal_vcode VARCHAR(7) NULL,
    FOREIGN KEY (student_id ) REFERENCES users_info(student_id)
);
-- users_post 
CREATE TABLE users_posts(
	post_id INT  AUTO_INCREMENT PRIMARY KEY,
    student_id INT(10),
    new_post TEXT(1000) NOT NULL,
    post_date TIMESTAMP NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users_info(student_id)
);