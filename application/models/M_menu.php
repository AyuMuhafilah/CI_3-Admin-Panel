<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends MY_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'menu';

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
        'menu' => [
            'type' => 'VARCHAR',
            'constraint' => 64,
            'null' => false,
        ],
        'url' => [
            'type' => 'VARCHAR',
            'constraint' => 128,
            'null' => false,
        ],
        'base_url' => [
            'type' => 'BOOLEAN',
            'null' => false,
        ],
        'parent_id' => [
            'type' => 'INTEGER',
            'constraint' => 11,
            'null' => true,
        ],
        'is_parent' => [
            'type' => 'BOOLEAN',
            'null' => false,
        ],
        'order' => [
            'type' => 'INTEGER',
            'constraint' => '4',
            'null' => false,
        ],
        'other' => [
            'type' => 'TEXT',
            'null' => true,
        ],
    ];

    /**
     * Data seeding
     * 
     * @var array $seed
     */
    protected $seed_data = [
        [
            'id' => 1,
            'menu' => 'Home',
            'url' => 'Home',
            'base_url' => true,
            'parent_id' => null,
            'is_parent' => false,
            'order' => 1,
            'other' => null,
        ],
        [
            'id' => 2,
            'menu' => 'Developer',
            'url' => '#',
            'base_url' => false,
            'parent_id' => null,
            'is_parent' => true,
            'order' => 2,
            'other' => null,
        ],
        [
            'id' => null,
            'menu' => 'Menu Management',
            'url' => 'Menu',
            'base_url' => true,
            'parent_id' => 2,
            'is_parent' => false,
            'order' => 1,
            'other' => null,
        ],
        [
            'id' => null,
            'menu' => 'Access Management',
            'url' => 'Access',
            'base_url' => true,
            'parent_id' => 2,
            'is_parent' => false,
            'order' => 2,
            'other' => null,
        ],
    ];

    /**
     * Ambil data modul berdasarkan hak akses user
     * 
     * @param int $user_id
     * @return array Sudah menjadi data array
     */
    public function auth(int $user_id)
    {
        // Load model jika belum di load
        if (!$this->load->is_loaded('M_menu_role')) $this->load->model('M_menu_role');
        if (!$this->load->is_loaded('M_user')) $this->load->model('M_user');

        // ambil role_user
        $this->db->select('role_id');
        $role_user = $this->M_user->find(['id' => $user_id])->row_array()['role_id'];

        return $this->M_menu_role->modules($role_user);
    }

    /**
     * Method untuk membantu Class Satpam mendapatkan data yang ia butuhkan.
     * 
     * Jangan gunakan di controller, hanya untuk Class Satpam saja.
     * 
     * @param int $role_id
     * @return CI_DB_result::class query result
     */
    public function modulesForSatpam(int $user_id)
    {
        // Load model jika belum di load
        if (!$this->load->is_loaded('M_menu_role')) $this->load->model('M_menu_role');
        if (!$this->load->is_loaded('M_user')) $this->load->model('M_user');

        // ambil role_user
        $this->db->select('role_id');
        $role_user = $this->M_user->find(['id' => $user_id])->row_array()['role_id'];

        return $this->M_menu_role->modulesForSatpam($role_user);
    }
}
