<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    // --- Database Settings ---
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;

    // Allowed fields for insert/update (Security: Mass Assignment Protection)
    protected $allowedFields = ['name', 'phone', 'password'];

    // --- Automatic Timestamps ---
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // --- Validation Rules ---
    protected $validationRules = [
        'name' => 'required|alpha_numeric_space|min_length[3]|max_length[100]',
        'phone' => 'required|numeric|min_length[10]',
        'password' => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'phone' => [
            'numeric'    => 'Please enter only numbers for the phone field.',
            'min_length' => 'The phone number is too short. It must be at least 10 digits.'
        ],
        'password' => [
            'min_length' => 'Password must be at least 8 characters long.'
        ]
    ];

    protected $skipValidation = false;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Automatically hashes the password before saving to database.
     */
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
}