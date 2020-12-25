<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu_role extends MY_Model
{
    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [
        [
            'menu_id' => 1,
            'role_id' => 1,
        ],
    ];

    /**
     * Fungsi yang di panggil pertamakali
     * 
     * Digunakan untuk me-load model yang dibutuhkan
     */
    public function __construct()
    {
        parent::__construct();

        // Load model
        $this->load->model('M_menu');
        $this->load->model('M_role');
    }

    public function joinMenu()
    {
        $this->db->join($this->M_menu->table, "{$this->M_menu->table}.{$this->M_menu->primaryKey} = {$this->table}.menu_id");
    }

    public function joinRole()
    {
        $this->db->join($this->M_role->table, "{$this->M_role->table}.{$this->M_role->primaryKey} = {$this->table}.role_id");
    }
}
