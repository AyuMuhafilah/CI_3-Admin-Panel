<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_role extends MY_Model
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
        'role' => [
            'type' => 'VARCHAR',
            'constraint' => 64,
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
            'role' => 'Developer',
        ],
        [
            'role' => 'Administrator',
        ],
    ];
}
