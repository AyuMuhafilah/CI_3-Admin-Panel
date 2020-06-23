<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{

    private $table = 'users';

    public function All()
    {
        return $this->db->get($this->table);
    }

    public function Find(array $find)
    {
        return $this->db->get_where($this->table, $find);
    }



}