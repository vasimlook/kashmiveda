<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Admin',
            'phone' => '9876543210',
            'password' => password_hash('admin@123', PASSWORD_DEFAULT),
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ];
        $this->db->table('admins')->insert($data);
    }
}
