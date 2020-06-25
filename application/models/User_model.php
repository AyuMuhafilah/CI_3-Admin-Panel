<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'users';

    /**
     * Ambil semua data
     * 
     * @return CI_DB_result::class query result
     */
    public function All()
    {
        return $this->db->get($this->table);
    }

    /**
     * Ambil data berdasarkan field (get_where)
     * 
     * @param array $find
     * @return CI_DB_result::class query result
     */
    public function Find(array $find)
    {
        return $this->db->get_where($this->table, $find);
    }
}
