<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends MY_Model
{
    /**
     * Nama tabel
     * 
     * @var string $table
     */
    public $table = 'user';

    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_role');

        $this->seed_data = [
            [
                'role_id' => 1,
                'username' => 'developer',
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ],
            [
                'role_id' => 2,
                'username' => 'administrator',
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ],
        ];
    }

    public function joinRole()
    {
        $this->db->join($this->M_role->table, "{$this->M_role->table}.{$this->M_role->primaryKey} = {$this->table}.role_id");
    }
}
