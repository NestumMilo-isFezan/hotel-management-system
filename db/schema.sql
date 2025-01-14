-- Create database if not exists
CREATE DATABASE IF NOT EXISTS hotelmanagement_test;
USE hotelmanagement_test;

-- Drop tables if they exist to ensure clean state
DROP TABLE IF EXISTS payment;
DROP TABLE IF EXISTS hotelservice;
DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS room;
DROP TABLE IF EXISTS roomtype;
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS staff;
DROP TABLE IF EXISTS guest;
DROP TABLE IF EXISTS hotel;
DROP TABLE IF EXISTS useracc;

-- Create useracc table
CREATE TABLE useracc (
    accID INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    userRoles INT(11) DEFAULT 2,
    registerdate DATE DEFAULT CURRENT_DATE
);

-- Create hotel table
CREATE TABLE hotel (
    hotelID INT PRIMARY KEY AUTO_INCREMENT,
    hotelname VARCHAR(255),
    contact VARCHAR(20),
    email VARCHAR(255),
    address VARCHAR(255),
    postcode VARCHAR(10),
    city VARCHAR(100),
    state VARCHAR(50),
    country VARCHAR(100),
    info TEXT,
    about TEXT,
    img_path VARCHAR(255)
);

-- Create guest table
CREATE TABLE guest (
    guestID INT PRIMARY KEY AUTO_INCREMENT,
    accID INT(11) NOT NULL,
    address VARCHAR(255),
    postcode VARCHAR(10),
    city VARCHAR(100),
    state VARCHAR(50),
    country VARCHAR(100),
    firstName VARCHAR(255),
    lastName VARCHAR(255),
    FOREIGN KEY (accID) REFERENCES useracc(accID)
);

-- Create staff table
CREATE TABLE staff (
    staffID INT PRIMARY KEY AUTO_INCREMENT,
    accID INT(11) NOT NULL,
    hotelID INT(11) NOT NULL,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    contact VARCHAR(20),
    FOREIGN KEY (accID) REFERENCES useracc(accID),
    FOREIGN KEY (hotelID) REFERENCES hotel(hotelID)
);

-- Create roomtype table
CREATE TABLE roomtype (
    typeID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(5,2),
    capacity INT(11),
    room_imgpath VARCHAR(255),
    hotelID INT(11) NOT NULL,
    FOREIGN KEY (hotelID) REFERENCES hotel(hotelID)
);

-- Create room table
CREATE TABLE room (
    roomID INT PRIMARY KEY AUTO_INCREMENT,
    hotelID INT(11) NOT NULL,
    typeID INT(11) NOT NULL,
    roomstatus VARCHAR(30) DEFAULT 'available',
    roomNo VARCHAR(5),
    FOREIGN KEY (hotelID) REFERENCES hotel(hotelID),
    FOREIGN KEY (typeID) REFERENCES roomtype(typeID)
);

-- Create booking table
CREATE TABLE booking (
    bookID INT PRIMARY KEY AUTO_INCREMENT,
    roomID INT(11) NOT NULL,
    serviceID INT(11),
    guestID INT(11) NOT NULL,
    check_in TIMESTAMP NULL,
    check_out TIMESTAMP NULL,
    total_price DECIMAL(19,4),
    status VARCHAR(30),
    FOREIGN KEY (roomID) REFERENCES room(roomID),
    FOREIGN KEY (guestID) REFERENCES guest(guestID)
);

-- Create hotelservice table
CREATE TABLE hotelservice (
    serviceID INT PRIMARY KEY AUTO_INCREMENT,
    hotelID INT(11) NOT NULL,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(5,2),
    servicestatus VARCHAR(30),
    FOREIGN KEY (hotelID) REFERENCES hotel(hotelID)
);

-- Create payment table
CREATE TABLE payment (
    paymentID INT PRIMARY KEY AUTO_INCREMENT,
    bookID INT(11) NOT NULL,
    amountpay DECIMAL(19,4),
    balance DECIMAL(19,4),
    method VARCHAR(50),
    paymentdate DATE DEFAULT CURRENT_DATE,
    paymenttime TIME DEFAULT CURRENT_TIME,
    FOREIGN KEY (bookID) REFERENCES booking(bookID)
);

-- Create news table
CREATE TABLE news (
    newsID INT PRIMARY KEY AUTO_INCREMENT,
    hotelID INT(11) NOT NULL,
    newstitle VARCHAR(255),
    description TEXT,
    registerdate DATE DEFAULT CURRENT_DATE,
    registertime TIME DEFAULT CURRENT_TIME,
    FOREIGN KEY (hotelID) REFERENCES hotel(hotelID)
);

-- Insert sample data for testing
INSERT INTO useracc (username, email, password, userRoles) VALUES
('admin', 'admin@example.com', '$2y$10$sample_hash', 1),
('test_guest', 'test@example.com', '$2y$10$sample_hash', 2);

INSERT INTO hotel (hotelname, contact, email) VALUES
('Test Hotel', '123456789', 'hotel@test.com');

-- Add more sample data as needed for testing
