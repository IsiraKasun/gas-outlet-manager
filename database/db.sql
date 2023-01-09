CREATE DATABASE gasoutlet;

USE gasoutlet;

CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    mobile VARCHAR(10),
    address VARCHAR(255)
);

CREATE TABle user_credentials (
    user_id INT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    user_type VARCHAR(20),
    FOREIGN KEY(user_id) REFERENCES user(user_id)
);

CREATE TABLE outlet (
    outlet_id INT AUTO_INCREMENT PRIMARY KEY,
    outlet_name VARCHAR(255),
    email VARCHAR(255),
    mobile VARCHAR(10),
    address VARCHAR(255),
    lan VARCHAR(255),
    lat VARCHAR(255),
    outlet_owner INT,
    FOREIGN KEY(outlet_owner) REFERENCES user(user_id)
);

INSERT INTO user (first_name, last_name, email, mobile, address)
VALUES
('user one first name', 'user one last name', 'userone@test.com', '0701234567', 'Colombo'),
('user two first name', 'user two last name', 'usertwo@test.com', '0711234567', 'Gampaha'),
('user three first name', 'user three last name', 'userthree@test.com', '0771234567', 'Colombo');


INSERT INTO user_credentials (user_id, username, password, user_type)
VALUES
('1', 'userone', SHA2('123', 256), 'admin'),
('2', 'usertwo', SHA2('123', 256), 'customer'),
('3', 'userthree', SHA2('123', 256), 'outlet');


