<?php

namespace App\Models;

use CodeIgniter\Model;

class Aduan_model extends Model
{
    protected $table = "aduan";

    public function tambahAduan($data)
    {
        $query = $this->db->table('aduan')->insert($data);
        return $query;
    }
}
