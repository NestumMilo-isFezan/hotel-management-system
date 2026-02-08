USE hotelmanagement_test;

-- 1. Insert Hotel
INSERT INTO hotel (hotelname, contact, email, address, postcode, city, state, country, info, about, img_path) 
VALUES ('Grand Aurora Spark Hotel', '+60123456789', 'contact@aurora-spark.com', '123 Jalan Ampang', '50450', 'Kuala Lumpur', 'WPKL', 'Malaysia', 
'A luxury stay in the heart of the city.', 'We provide the best hospitality service since 2025.', 'aurora-spark.jpg');

-- 2. Insert Users (Password is 'password' for all)
-- Roles: 1 = Admin/Staff, 2 = Guest
INSERT INTO useracc (username, email, password, userRoles) VALUES
('manager', 'manager@hotel.com', '$2y$10$8K9pYJtF7C1ZpY6w5W7U7e5eG6v7e5eG6v7e5eG6v7e5eG6v7e5e', 1),
('staff01', 'staff01@hotel.com', '$2y$10$8K9pYJtF7C1ZpY6w5W7U7e5eG6v7e5eG6v7e5eG6v7e5eG6v7e5e', 1),
('guest01', 'guest01@gmail.com', '$2y$10$8K9pYJtF7C1ZpY6w5W7U7e5eG6v7e5eG6v7e5eG6v7e5eG6v7e5e', 2),
('guest02', 'guest02@gmail.com', '$2y$10$8K9pYJtF7C1ZpY6w5W7U7e5eG6v7e5eG6v7e5eG6v7e5eG6v7e5e', 2);

-- 3. Insert Guests
INSERT INTO guest (accID, firstName, lastName, city, country) VALUES
(3, 'John', 'Doe', 'Singapore', 'Singapore'),
(4, 'Jane', 'Smith', 'London', 'UK');

-- 4. Insert Staff
INSERT INTO staff (accID, hotelID, firstName, lastName, contact) VALUES
(1, 1, 'Hotel', 'Manager', '+60111222333'),
(2, 1, 'Ahmad', 'Fauzi', '+60111222444');

-- 5. Insert Room Types
INSERT INTO roomtype (name, description, price, capacity, room_imgpath, hotelID) VALUES
('Single Room', 'Cozy room for solo travelers.', 150.00, 1, 'test1.jpg', 1),
('Double Deluxe', 'Spacious room for couples.', 250.00, 2, 'test2.jpg', 1),
('Family Suite', 'Perfect for family vacations with 2 bedrooms.', 500.00, 4, 'japanese_corner.jpeg', 1);

-- 6. Insert Rooms
INSERT INTO room (hotelID, typeID, roomNo, roomstatus) VALUES
(1, 1, '101', 'available'),
(1, 1, '102', 'available'),
(1, 2, '201', 'available'),
(1, 2, '202', 'available'),
(1, 3, '301', 'available');

-- 7. Insert Hotel Services
INSERT INTO hotelservice (hotelID, name, description, price, servicestatus) VALUES
(1, 'Breakfast Buffet', 'All you can eat morning meal.', 25.00, 'active'),
(1, 'Airport Transfer', 'Convenient pickup and drop service.', 50.00, 'active'),
(1, 'Room Cleaning', 'Daily housekeeping service.', 0.00, 'active');

-- 8. Insert News
INSERT INTO news (hotelID, newstitle, description) VALUES
(1, 'Grand Opening!', 'We are excited to announce our grand opening ceremony next week.'),
(1, 'New Swimming Pool', 'Our infinity pool is now open for all guests from 7 AM to 10 PM.'),
(1, 'Holiday Discount', 'Get 20% off for bookings made during the month of December!');
