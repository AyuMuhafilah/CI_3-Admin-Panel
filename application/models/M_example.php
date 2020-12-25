<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_example extends MY_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'example';

    /**
     * Nama primary key
     * 
     * @var string $primaryKey
     */
    public $primaryKey = 'id';

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
        $this->load->model('M_foo');
    }

    /**
     * Join dengan tabel foo
     * 
     * @return viod
     */
    public function joinFoo()
    {
        $this->db->join($this->M_foo->table, "{$this->M_foo->table}.{$this->M_foo->primaryKey} = {$this->table}.foo_id");
    }
}
