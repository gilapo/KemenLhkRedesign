<?php

namespace App\Controllers;

class Berita extends BaseController
{

    public function detail($slug)
    {
        $data = [
            'judul' => 'berita',
            'berita' => $this->beritaModel->getBerita($slug)
        ];

        if (empty($data['berita'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('berita tidak ditemukan');
        }

        return view('berita/berita', $data);
    }

    public function create()
    {
        $data = [
            'judul' => 'tambah berita',
            'validation' => \Config\Services::validation()
        ];

        return view('berita/tambahBerita', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[berita.judul]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->beritaModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'isi' => $this->request->getVar('isi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Berita Ditambahkan');
        return redirect()->to('/');
    }

    public function delete($id)
    {
        $this->beritaModel->delete($id);
        session()->setFlashdata('pesan', 'Berita Dihapus');
        return redirect()->to("/");
    }

    //--------------------------------------------------------------------

}
