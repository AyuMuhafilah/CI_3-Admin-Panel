<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Example_model extends MY_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'Example';

    /**
     * Nama primary key
     * 
     * @var string $primaryKey
     */
    public $primaryKey = 'id';

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
    ];

    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [
        [
            'foo_id' => 1,
            'field_name' => 'whatever',
        ],
        [
            'foo_id' => 2,
            'field_name' => 'also whatever',
        ],
    ];

    /**
     * Fungsi yang pertamakali di jalankan
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Load model jika belum di load
        if (!$this->load->is_loaded('Foo_model')) $this->load->model('Foo_model', 'foo_model');

        $this->add_fields = [
            "FOREIGN KEY (`foo_id`) REFERENCES `{$this->foo_model->table}`(`{$this->foo_model->primaryKey}`)",
        ];
    }

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
