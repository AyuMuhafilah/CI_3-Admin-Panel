<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module_model extends CI_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'modules';

    /**
     * Ambil semua data
     * 
     * @return CI_DB_result::class query result
     */
    public function all()
    {
        return $this->db->get($this->table);
    }

    /**
     * Ambil data berdasarkan field (get_where)
     * 
     * @param array $find
     * @return CI_DB_result::class query result
     */
    public function find(array $find)
    {
        return $this->db->get_where($this->table, $find);
    }

    /**
     * Ambil data modul berdasarkan hak akses user
     * 
     * @param int $user_id
     * @return array Sudah menjadi data array
     */
    public function auth(int $user_id)
    {
        // Load model jika belum di load
        if (!$this->load->is_loaded('Module_role_model')) $this->load->model('Module_role_model', 'module_role_model');
        if (!$this->load->is_loaded('User_model')) $this->load->model('User_model', 'user_model');

        // ambil role_user
        $this->db->select('role_id');
        $role_user = $this->user_model->find(['id' => $user_id])->row_array()['role_id'];

        return $this->module_role_model->modules($role_user);
    }
}
