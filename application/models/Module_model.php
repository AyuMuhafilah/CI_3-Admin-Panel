<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module_model extends CI_Model
{
    private $table = 'modules';

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
     * @param array $find
     * @return CI_DB_result::class query result
     */
    public function auth(int $user_id)
    {
        $this->load->model('User_model', 'user_model');

        // Query builder start
        $this->db->select('role_id');
        $role_user = $this->user_model->find(['id' => $user_id])->row_array()['role_id']; // ambil role_user
        // Query builder stop

        // Query builder start
        $this->db->where('role_id', $role_user);
        $this->db->join($this->table, 'modules.id = module_id');
        return $this->db->get('module_role');
        // Query builder stop
    }
}
