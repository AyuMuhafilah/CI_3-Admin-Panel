<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_foo extends MY_Model
{
    /**
     * Nama nama field
     * 
     * @var array $fields
     */
    protected $fields = [
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
    ];

    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [
        [
            'field_name' => 'anything',
        ],
        [
            'field_name' => 'also anything',
        ],
    ];
}
