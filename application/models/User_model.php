<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'users';

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
}
