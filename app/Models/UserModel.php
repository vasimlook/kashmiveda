<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'phone',
        'password',
        'user_code',
        'referral_code',
        'level_1',
        'level_2',
        'level_3',
        'balance',
        'status',
        'uuid',
        'level_1_commission',
        'level_2_commission',
        'level_3_commission',
        'total_commission',
        'total_withdrawal',
        'otp_code',
        'otp_expires_at',
        'bank_name',
        'bank_holder_name',
        'ifsc_code',
        'acc_no',
        'phone_pay',
        'g_pay',
        'otp_verify',
        'otp_count',
        'otp_date',
        'pwd_count',
        'pwd_date'
    ];

    protected $useTimestamps = true;

    protected $beforeInsert = ['hashPassword', 'generateUUID'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    protected function generateUUID(array $data)
    {
        if (!isset($data['data']['uuid'])) {
            $data['data']['uuid'] = $this->uuidv4();
        }
        return $data;
    }

    private function uuidv4()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function findByUuid($uuid)
    {
        return $this->where('uuid', $uuid)->first();
    }

    public function updateBalance(int $userId, float $amount, bool $isIncrement = true, string $column = 'balance')
    {
        if ($userId <= 0 || $amount <= 0)
            return false;

        $builder = $this->db->table('users');
        $builder->where('id', $userId);

        if ($isIncrement) {
            $builder->set($column, "$column + $amount", false);
        } else {
            $builder->where("$column >=", $amount);
            $builder->set($column, "$column - $amount", false);
        }

        $builder->update();

        return $this->db->affectedRows() > 0;
    }
}