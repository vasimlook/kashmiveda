<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToProducts extends Migration
{
    public function up()
    {
        $fields = [
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'price'
            ],
            'level_1_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0.00,
                'after' => 'description'
            ],
            'level_2_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0.00,
                'after' => 'level_1_commission'
            ],
            'level_3_commission' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0.00,
                'after' => 'level_2_commission'
            ],
        ];
        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', ['description', 'level_1_commission', 'level_2_commission', 'level_3_commission']);
    }
}
