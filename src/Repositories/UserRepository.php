<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class UserRepository extends Repository
{
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM useracc WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function findGuestByAccId(int $accId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM guest WHERE accID = :accId LIMIT 1");
        $stmt->execute(['accId' => $accId]);
        return $stmt->fetch() ?: null;
    }

    public function findStaffByAccId(int $accId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM staff WHERE accID = :accId LIMIT 1");
        $stmt->execute(['accId' => $accId]);
        return $stmt->fetch() ?: null;
    }

    public function getGuestDetails(int $guestId): ?array
    {
        $stmt = $this->db->prepare("SELECT guest.*, useracc.username, useracc.email FROM guest
                                    JOIN useracc ON guest.accID = useracc.accID
                                    WHERE guest.guestID = :guestId");
        $stmt->execute(['guestId' => $guestId]);
        return $stmt->fetch() ?: null;
    }

    public function updateGuest(int $guestId, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE guest SET 
            firstName = :fname, 
            lastName = :lname, 
            address = :address, 
            postcode = :postcode, 
            city = :city, 
            state = :state, 
            country = :country 
            WHERE guestID = :guestId");
        
        $data['guestId'] = $guestId;
        return $stmt->execute($data);
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare("INSERT INTO useracc (username, email, password, userRoles) VALUES (:username, :email, :password, 2)");
        $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function createGuest(array $data): bool
    {
        $stmt = $this->db->prepare("INSERT INTO guest (accID, firstName, lastName, address, postcode, city, state, country) 
                                    VALUES (:accId, :fname, :lname, '', '', '', '', '')");
        return $stmt->execute([
            'accId' => $data['accId'],
            'fname' => $data['fname'],
            'lname' => $data['lname']
        ]);
    }
}
