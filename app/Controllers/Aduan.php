<?php

namespace App\Controllers;

use App\Models\Aduan_model;

class Aduan extends BaseController
{

    public function index()
    {
        $model = new Aduan_model();
        $data = array(
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'isi' => $this->request->getPost('isi'),
        );
        $model->tambahAduan($data);
        return redirect()->to('/home');
    }
}
