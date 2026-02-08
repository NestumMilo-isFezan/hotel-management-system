<?php
declare(strict_types=1);

namespace App\Database\Migrations;

use App\Core\Migration;

class CreateInitialTables extends Migration
{
    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS useracc (
                accID INT PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                userRoles INT DEFAULT 2,
                registerdate DATE DEFAULT (CURRENT_DATE)
            );

            CREATE TABLE IF NOT EXISTS hotel (
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

            CREATE TABLE IF NOT EXISTS guest (
                guestID INT PRIMARY KEY AUTO_INCREMENT,
                accID INT NOT NULL,
                address VARCHAR(255),
                postcode VARCHAR(10),
                city VARCHAR(100),
                state VARCHAR(50),
                country VARCHAR(100),
                firstName VARCHAR(255),
                lastName VARCHAR(255),
                FOREIGN KEY (accID) REFERENCES useracc(accID) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS staff (
                staffID INT PRIMARY KEY AUTO_INCREMENT,
                accID INT NOT NULL,
                hotelID INT NOT NULL,
                firstName VARCHAR(100),
                lastName VARCHAR(100),
                contact VARCHAR(20),
                FOREIGN KEY (accID) REFERENCES useracc(accID) ON DELETE CASCADE,
                FOREIGN KEY (hotelID) REFERENCES hotel(hotelID) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS roomtype (
                typeID INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(100),
                description TEXT,
                price DECIMAL(10,2),
                capacity INT,
                room_imgpath VARCHAR(255),
                hotelID INT NOT NULL,
                FOREIGN KEY (hotelID) REFERENCES hotel(hotelID) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS room (
                roomID INT PRIMARY KEY AUTO_INCREMENT,
                hotelID INT NOT NULL,
                typeID INT NOT NULL,
                roomstatus VARCHAR(30) DEFAULT 'available',
                roomNo VARCHAR(10),
                FOREIGN KEY (hotelID) REFERENCES hotel(hotelID) ON DELETE CASCADE,
                FOREIGN KEY (typeID) REFERENCES roomtype(typeID) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS hotelservice (
                serviceID INT PRIMARY KEY AUTO_INCREMENT,
                hotelID INT NOT NULL,
                name VARCHAR(100),
                description TEXT,
                price DECIMAL(10,2),
                servicestatus VARCHAR(30),
                FOREIGN KEY (hotelID) REFERENCES hotel(hotelID) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS booking (
                bookID INT PRIMARY KEY AUTO_INCREMENT,
                roomID INT NOT NULL,
                serviceID INT,
                guestID INT NOT NULL,
                check_in TIMESTAMP NULL,
                check_out TIMESTAMP NULL,
                total_price DECIMAL(19,4),
                status VARCHAR(30),
                FOREIGN KEY (roomID) REFERENCES room(roomID) ON DELETE CASCADE,
                FOREIGN KEY (guestID) REFERENCES guest(guestID) ON DELETE CASCADE,
                FOREIGN KEY (serviceID) REFERENCES hotelservice(serviceID) ON DELETE SET NULL
            );

            CREATE TABLE IF NOT EXISTS payment (
                paymentID INT PRIMARY KEY AUTO_INCREMENT,
                bookID INT NOT NULL,
                amountpay DECIMAL(19,4),
                balance DECIMAL(19,4),
                method VARCHAR(50),
                paymentdate DATE DEFAULT (CURRENT_DATE),
                paymenttime TIME DEFAULT (CURRENT_TIME),
                FOREIGN KEY (bookID) REFERENCES booking(bookID) ON DELETE CASCADE
            );

            CREATE TABLE IF NOT EXISTS news (
                newsID INT PRIMARY KEY AUTO_INCREMENT,
                hotelID INT NOT NULL,
                newstitle VARCHAR(255),
                description TEXT,
                registerdate DATE DEFAULT (CURRENT_DATE),
                registertime TIME DEFAULT (CURRENT_TIME),
                FOREIGN KEY (hotelID) REFERENCES hotel(hotelID) ON DELETE CASCADE
            );
        ";
        $this->db->exec($sql);
    }

    public function down(): void
    {
        $this->db->exec("DROP TABLE IF EXISTS news, payment, booking, hotelservice, room, roomtype, staff, guest, hotel, useracc;");
    }
}
