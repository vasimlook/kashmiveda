<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSecurityFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'otp_verify' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '0 = Not Verified, 1 = Verified',
                'after' => 'otp_code'
            ],
            'otp_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'comment' => 'Count of OTPs sent to daily limit',
                'after' => 'otp_verify'
            ],
            'otp_date' => [
                'type' => 'DATE',
                'null' => true,
                'comment' => 'Date of the last otp send date',
                'after' => 'otp_count',
            ],
            'pwd_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'comment' => 'Number of times password was changed',
                'after' => 'otp_expires_at'
            ],
            'pwd_date' => [
                'type' => 'DATE',
                'null' => true,
                'comment' => 'Date of the last password update',
                'after' => 'pwd_count',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['otp_verify', 'otp_count', 'pwd_count', 'pwd_date','otp_date']);
    }
}
