<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_buat_tabel_role extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => false,
            ],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('role');
    }

    public function down()
    {
        $this->dbforge->drop_table('role');
    }
}
