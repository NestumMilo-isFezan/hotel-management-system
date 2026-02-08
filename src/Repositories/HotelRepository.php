<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Repository;

class HotelRepository extends Repository
{
    public function getHotelInfo(int $id = 1): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM hotel WHERE hotelID = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        
        if ($data) {
            $data['hotelimg'] = "/upload/home/" . ($data['img_path'] ?: 'default.jpg');
            $data['full_address'] = "{$data['address']}, {$data['city']}, {$data['postcode']}, {$data['state']}, {$data['country']}";
        }
        
        return $data ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE hotel SET 
            hotelname = :hotelname, 
            email = :email, 
            contact = :contact, 
            address = :address, 
            postcode = :postcode, 
            city = :city, 
            state = :state, 
            info = :info, 
            about = :about 
            WHERE hotelID = :id");
        
        $data['id'] = $id;
        return $stmt->execute($data);
    }
}
