<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends MY_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'user';

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
            'null' => false,
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

        $this->load->model('M_role');

        $this->add_fields = [
            "FOREIGN KEY (`role_id`) REFERENCES `{$this->M_role->table}`(`{$this->M_role->primaryKey}`)"
        ];

        $this->load->model('M_role');
    }

    public function joinRole()
    {
        $this->db->join($this->M_role->table, "{$this->M_role->table}.{$this->M_role->primaryKey} = {$this->table}.role_id");
    }
}
