<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_buat_tabel_menu extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'menu' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => false,
            ],
            'url' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false,
            ],
            'base_url' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
            'parent_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'null' => true,
            ],
            'is_parent' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
            'order' => [
                'type' => 'INTEGER',
                'constraint' => '4',
                'null' => false,
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('menu');
    }

    public function down()
    {
        $this->dbforge->drop_table('menu');
    }
}
