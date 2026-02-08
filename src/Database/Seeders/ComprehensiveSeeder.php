<?php
declare(strict_types=1);

namespace App\Database\Seeders;

use App\Core\Seeder;

class ComprehensiveSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks for a clean seed
        $this->db->exec("SET FOREIGN_KEY_CHECKS = 0");
        $this->db->exec("TRUNCATE TABLE news");
        $this->db->exec("TRUNCATE TABLE payment");
        $this->db->exec("TRUNCATE TABLE booking");
        $this->db->exec("TRUNCATE TABLE hotelservice");
        $this->db->exec("TRUNCATE TABLE room");
        $this->db->exec("TRUNCATE TABLE roomtype");
        $this->db->exec("TRUNCATE TABLE staff");
        $this->db->exec("TRUNCATE TABLE guest");
        $this->db->exec("TRUNCATE TABLE hotel");
        $this->db->exec("TRUNCATE TABLE useracc");
        $this->db->exec("SET FOREIGN_KEY_CHECKS = 1");

        // 1. Seed Hotel
        $stmt = $this->db->prepare("INSERT INTO hotel (hotelname, contact, email, address, city, postcode, state, country, info, about, img_path) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            'Grand Horizon Luxury Resort',
            '+60 88-123456',
            'management@grandhorizon.com',
            'Lot 42, Coastal Road',
            'Kota Kinabalu',
            '88000',
            'Sabah',
            'Malaysia',
            'Experience the pinnacle of luxury by the sea.',
            'Founded in 2020, Grand Horizon has quickly become the premier destination for travelers seeking comfort, security, and world-class service in East Malaysia.',
            'aurora-spark.jpg'
        ]);
        $hotelId = (int)$this->db->lastInsertId();

        // 2. Seed Users
        $stmt = $this->db->prepare("INSERT INTO useracc (username, email, password, userRoles) VALUES (?, ?, ?, ?)");
        $commonPass = password_hash('password123', PASSWORD_DEFAULT);
        
        // Admin/Staff
        $stmt->execute(['admin_user', 'admin@grandhorizon.com', $commonPass, 1]);
        $adminAccId = (int)$this->db->lastInsertId();
        
        // Guests
        $stmt->execute(['johndoe', 'john@example.com', $commonPass, 2]);
        $guest1AccId = (int)$this->db->lastInsertId();
        
        $stmt->execute(['janedoe', 'jane@example.com', $commonPass, 2]);
        $guest2AccId = (int)$this->db->lastInsertId();

        // 3. Seed Staff
        $stmt = $this->db->prepare("INSERT INTO staff (accID, hotelID, firstName, lastName, contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$adminAccId, $hotelId, 'Ahmad', 'Zaki', '012-8889999']);

        // 4. Seed Guest Details
        $stmt = $this->db->prepare("INSERT INTO guest (accID, firstName, lastName, address, city, postcode, state, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$guest1AccId, 'John', 'Doe', '123 Main St', 'Kuala Lumpur', '50000', 'WP', 'Malaysia']);
        $guest1Id = (int)$this->db->lastInsertId();
        
        $stmt->execute([$guest2AccId, 'Jane', 'Doe', '456 Garden Ave', 'Penang', '11000', 'Pulau Pinang', 'Malaysia']);
        $guest2Id = (int)$this->db->lastInsertId();

        // 5. Seed Room Types
        $stmt = $this->db->prepare("INSERT INTO roomtype (hotelID, name, description, price, capacity, room_imgpath) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$hotelId, 'Standard Queen', 'Comfortable queen bed with city view.', 180.00, 2, 'default.jpg']);
        $standardId = (int)$this->db->lastInsertId();
        
        $stmt->execute([$hotelId, 'Deluxe King', 'Spacious king bed with balcony and sea view.', 350.00, 2, 'japanese_corner.jpeg']);
        $deluxeId = (int)$this->db->lastInsertId();
        
        $stmt->execute([$hotelId, 'Family Suite', 'Two bedrooms, living area, and kitchenette.', 650.00, 4, 'default.jpg']);
        $familyId = (int)$this->db->lastInsertId();

        // 6. Seed Rooms
        $stmt = $this->db->prepare("INSERT INTO room (hotelID, typeID, roomNo, roomstatus) VALUES (?, ?, ?, ?)");
        $stmt->execute([$hotelId, $standardId, '101', 'available']);
        $room101Id = (int)$this->db->lastInsertId();
        $stmt->execute([$hotelId, $standardId, '102', 'available']);
        $stmt->execute([$hotelId, $deluxeId, '201', 'available']);
        $room201Id = (int)$this->db->lastInsertId();
        $stmt->execute([$hotelId, $deluxeId, '202', 'available']);
        $stmt->execute([$hotelId, $familyId, '301', 'available']);
        $room301Id = (int)$this->db->lastInsertId();

        // 7. Seed Services
        $stmt = $this->db->prepare("INSERT INTO hotelservice (hotelID, name, description, price, servicestatus) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$hotelId, 'Breakfast Buffet', 'All-you-can-eat international breakfast.', 45.00, 'available']);
        $serviceBfId = (int)$this->db->lastInsertId();
        $stmt->execute([$hotelId, 'Airport Transfer', 'Premium shuttle to and from BKI airport.', 80.00, 'available']);
        $serviceAirId = (int)$this->db->lastInsertId();
        $stmt->execute([$hotelId, 'Spa & Massage', '1-hour full body relaxation therapy.', 120.00, 'available']);

        // 8. Seed News
        $stmt = $this->db->prepare("INSERT INTO news (hotelID, newstitle, description, registerdate, registertime) VALUES (?, ?, ?, CURRENT_DATE, CURRENT_TIME)");
        $stmt->execute([$hotelId, 'New Sea-View Wing Opened', 'We are excited to announce the opening of our new wing featuring 50 additional luxury rooms.']);
        $stmt->execute([$hotelId, "Chef's Special Menu", 'Visit our Horizon Restaurant this weekend for an exclusive seafood platter by Chef Marco.']);
        $stmt->execute([$hotelId, 'Sustainability Initiative', 'Grand Horizon is now 100% plastic-straw free as part of our green earth commitment.']);

        // 9. Seed Bookings (Various States)
        $stmt = $this->db->prepare("INSERT INTO booking (roomID, serviceID, guestID, check_in, check_out, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Pending booking
        $stmt->execute([$room101Id, $serviceBfId, $guest1Id, '2026-03-01 14:00:00', '2026-03-03 12:00:00', 405.00, 'pending']);
        $bookingPendingId = (int)$this->db->lastInsertId();
        
        // Confirmed booking
        $stmt->execute([$room201Id, $serviceAirId, $guest2Id, '2026-02-10 14:00:00', '2026-02-12 12:00:00', 780.00, 'confirmed']);
        $bookingConfirmedId = (int)$this->db->lastInsertId();
        
        // Current Check-In (Room marked unavailable)
        $stmt->execute([$room301Id, null, $guest1Id, '2026-02-05 14:00:00', '2026-02-08 12:00:00', 1950.00, 'checkin']);
        $bookingCheckInId = (int)$this->db->lastInsertId();
        $this->db->exec("UPDATE room SET roomstatus = 'unavailable' WHERE roomID = $room301Id");

        // 10. Seed Payments
        $stmt = $this->db->prepare("INSERT INTO payment (bookID, amountpay, balance, method, paymentdate, paymenttime) VALUES (?, ?, ?, ?, CURRENT_DATE, CURRENT_TIME)");
        
        // Partial payment for check-in booking
        $stmt->execute([$bookingCheckInId, 1000.00, 950.00, 'Credit Card']);
        
        // Full payment for a past booking (simulated)
        $stmt->execute([$bookingConfirmedId, 780.00, 0.00, 'E-Wallet']);

        echo "Seeding completed successfully!
";
    }
}
