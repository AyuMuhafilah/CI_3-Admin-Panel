<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'users';

    /**
     * Nama nama field
     * 
     * @var array $fields
     */
    protected $fields = [
        'id' => [
            'type' => 'BIGINT',
            'constraint' => 20,
            'auto_increment' => true,
        ],
        'role_id' => [
            'type' => 'INTEGER',
            'constraint' => 11,
            'auto_increment' => true,
        ],
        'username' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
            'null' => false,
        ],
        'password' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
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
            'role_id' => 1,
            'username' => 'developer',
            'password' => '123',
        ],
        [
            'role_id' => 2,
            'username' => 'administrator',
            'password' => '123',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        if (!$this->load->is_loaded('Role_model')) $this->load->model('Role_model', 'role_model');

        $this->add_fields = [
            "FOREIGN KEY (`role_id`) REFERENCES `{$this->role_model->table}`(`{$this->role_model->primaryKey}`)"
        ];
    }
}
