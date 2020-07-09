<?php

namespace App\Models;

use CodeIgniter\Model;

class Berita_model  extends Model
{
    protected $table = "berita";
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'isi', 'deskripsi', 'penulis', 'sampul'];

    public function getBerita($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
