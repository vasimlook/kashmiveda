<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCommissionFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'uuid' => [
                'type' => 'VARCHAR',
                'constraint' => '36',
                'after' => 'id',
                'unique' => true,
            ],
            'level_1_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'after' => 'level_3',
            ],
            'level_2_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'after' => 'level_1_commission',
            ],
            'level_3_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'after' => 'level_2_commission',
            ],
            'total_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'balance',
            ],
            'total_withdrawal' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'total_commission',
            ],
            'otp_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '6',
                'null'       => true,
                'after'      => 'total_withdrawal',
            ],
            'otp_expires_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'otp_code',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'uuid',
            'level_1_commission',
            'level_2_commission',
            'level_3_commission',
            'total_commission',
            'total_withdrawal',
            'otp_code',
            'otp_expires_at',
        ]);
    }
}
