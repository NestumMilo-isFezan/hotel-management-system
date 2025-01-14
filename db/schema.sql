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

-- Insert more sample data for testing

-- Add more user accounts
INSERT INTO useracc (username, email, password, userRoles, registerdate) VALUES
('staff1', 'staff1@hotel.com', '$2y$10$sample_hash', 1, '2024-01-01'),
('staff2', 'staff2@hotel.com', '$2y$10$sample_hash', 1, '2024-01-01'),
('guest1', 'guest1@email.com', '$2y$10$sample_hash', 2, '2024-01-15'),
('guest2', 'guest2@email.com', '$2y$10$sample_hash', 2, '2024-01-20'),
('guest3', 'guest3@email.com', '$2y$10$sample_hash', 2, '2024-02-01');

-- Add more hotel data
INSERT INTO hotel (hotelname, contact, email, address, postcode, city, state, country, info, about) VALUES
('Grand Hotel', '123-456-7890', 'info@grandhotel.com', '123 Main Street', '12345', 'Cityville', 'State', 'Country', 'Luxury hotel in city center', 'Experience luxury at its finest'),
('Beach Resort', '987-654-3210', 'info@beachresort.com', '456 Beach Road', '54321', 'Beachtown', 'Coastal State', 'Country', 'Beautiful beachfront resort', 'Your perfect beach getaway');

-- Add guest information
INSERT INTO guest (accID, address, postcode, city, state, country, firstName, lastName) VALUES
(3, '789 Resident St', '67890', 'Hometown', 'State', 'Country', 'John', 'Doe'),
(4, '321 House Ave', '98765', 'Village', 'State', 'Country', 'Jane', 'Smith'),
(5, '456 Road St', '43210', 'Town', 'State', 'Country', 'Bob', 'Johnson');

-- Add staff members
INSERT INTO staff (accID, hotelID, firstName, lastName, contact) VALUES
(1, 1, 'Admin', 'User', '111-222-3333'),
(2, 1, 'Staff', 'Member', '444-555-6666');

-- Add room types
INSERT INTO roomtype (name, description, price, capacity, hotelID) VALUES
('Standard', 'Comfortable room with basic amenities', 99.99, 2, 1),
('Deluxe', 'Spacious room with premium amenities', 149.99, 2, 1),
('Suite', 'Luxury suite with separate living area', 299.99, 4, 1),
('Beach View', 'Room with beautiful ocean view', 199.99, 2, 2),
('Presidential', 'Our most luxurious accommodation', 499.99, 4, 2);

-- Add rooms
INSERT INTO room (hotelID, typeID, roomstatus, roomNo) VALUES
(1, 1, 'available', '101'),
(1, 1, 'occupied', '102'),
(1, 2, 'available', '201'),
(1, 2, 'maintenance', '202'),
(1, 3, 'available', '301'),
(2, 4, 'available', '101'),
(2, 4, 'occupied', '102'),
(2, 5, 'available', '201');

-- Add hotel services
INSERT INTO hotelservice (hotelID, name, description, price, servicestatus) VALUES
(1, 'Room Service', '24/7 in-room dining service', 0.00, 'available'),
(1, 'Spa Treatment', 'Relaxing spa services', 89.99, 'available'),
(1, 'Airport Shuttle', 'Transportation to/from airport', 29.99, 'available'),
(2, 'Beach Equipment', 'Rental of beach chairs and umbrellas', 19.99, 'available'),
(2, 'Water Sports', 'Various water sport activities', 49.99, 'available');

-- Add bookings
INSERT INTO booking (roomID, serviceID, guestID, check_in, check_out, total_price, status) VALUES
(1, 1, 1, '2024-03-15 14:00:00', '2024-03-20 11:00:00', 499.95, 'confirmed'),
(2, 2, 2, '2024-03-16 15:00:00', '2024-03-18 11:00:00', 299.97, 'checkin'),
(3, 1, 3, '2024-03-20 14:00:00', '2024-03-25 11:00:00', 749.95, 'pending'),
(6, 4, 1, '2024-03-25 14:00:00', '2024-03-30 11:00:00', 999.95, 'confirmed');

-- Add payments
INSERT INTO payment (bookID, amountpay, balance, method, paymentdate, paymenttime) VALUES
(1, 499.95, 0.00, 'credit_card', '2024-03-14', '10:30:00'),
(2, 299.97, 0.00, 'cash', '2024-03-16', '09:15:00'),
(4, 999.95, 0.00, 'credit_card', '2024-03-20', '14:45:00');

-- Add news/announcements
INSERT INTO news (hotelID, newstitle, description, registerdate, registertime) VALUES
(1, 'Summer Special', 'Enjoy 20% off on all rooms this summer!', '2024-03-01', '09:00:00'),
(1, 'New Spa Services', 'Try our new relaxation treatments', '2024-03-05', '11:30:00'),
(2, 'Beach Festival', 'Join us for the annual beach festival', '2024-03-10', '10:00:00'),
(2, 'Holiday Packages', 'Special holiday packages available', '2024-03-15', '13:45:00');

-- Add more sample data as needed for testing
