<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_buat_tabel_example extends CI_Migration
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
            'foo_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'null' => false,
            ],
            'field_name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false,
            ],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_field("CONSTRAINT `fk_foo_id` FOREIGN KEY (`foo_id`) REFERENCES `foo` (`id`)");
        $this->dbforge->create_table('example');
    }

    public function down()
    {
        $this->dbforge->drop_table('example');
    }
}
