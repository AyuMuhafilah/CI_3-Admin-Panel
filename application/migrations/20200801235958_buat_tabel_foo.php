<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_buat_tabel_foo extends CI_Migration
{
    public function up()
    {
        // Nama field
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'field_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false,
            ],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('foo');
    }

    public function down()
    {
        $this->dbforge->drop_table('foo');
    }
}
