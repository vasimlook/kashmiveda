<?php

namespace App\Models;

use CodeIgniter\Model;

class WithdrawalModel extends Model
{
    protected $table = 'withdrawals';
    protected $primaryKey = 'id';

    // This is the important part
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $allowedFields = [
        'user_id',
        'amount',
        'payment_details',
        'status',
        'accept_by',
        'accept_date'
    ];

    public function getPendingWithdraw($user_id)
    {
        return $this->where('user_id', $user_id)
            ->where("status", 0)
            ->first();
    }
}