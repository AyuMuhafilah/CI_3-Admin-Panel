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

    /**
     * Join dengan tabel foo
     * 
     * @return viod
     */
    public function joinFoo()
    {
        $this->db->join($this->foo_model->table, "{$this->foo_model->table}.{$this->foo_model->primarykey} = {$this->table}.foo_id");
    }
}
