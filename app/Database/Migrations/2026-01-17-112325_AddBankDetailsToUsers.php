<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBankDetailsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'bank_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'otp_expires_at',
            ],
            'bank_holder_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'bank_name',
            ],
            'ifsc_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'bank_holder_name',
            ],
            'acc_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'after'      => 'ifsc_code',
            ],
            'phone_pay' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'after'      => 'acc_no',
            ],
            'g_pay' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'after'      => 'phone_pay',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'bank_name', 
            'bank_holder_name', 
            'ifsc_code', 
            'acc_no', 
            'phone_pay', 
            'g_pay'
        ]);
    }
}
