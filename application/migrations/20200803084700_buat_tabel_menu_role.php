<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_buat_tabel_menu_role extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'menu_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'null' => false,
            ],
            'role_id' => [
                'type' => 'INTEGER',
                'constraint' => 11,
                'null' => false,
            ],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_field("COSTRAINT `fk_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)");
        $this->dbforge->add_field("CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)");
        $this->dbforge->create_table('menu_role');
    }

    public function down()
    {
        $this->dbforge->drop_table('menu_role');
    }
}
