<?php

namespace App\Controllers;

class Berita extends BaseController
{

    public function index()
    {
        // $isi = $this->model->findAll();
        $data = [
            'judul' => 'kementrian Lingkungan Hidup dan kehutanan',
            'berita' => $this->beritaModel->getAllBerita(),
        ];
        return view('Berita/berita', $data);
    }

    public function detail($slug)
    {
        $data = [
            'judul' => 'berita',
            'berita' => $this->beritaModel->getAllBerita($slug)
        ];

        if (empty($data['berita'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('berita tidak ditemukan');
        }

        return view('berita/detilberita', $data);
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
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'masukan gambar sampul',
                    'max_size' => 'pilih gambar dibawah 2 MB',
                    'is_image' => 'hanya boleh memasukkan gambar',
                    'mime_in' => 'hanya boleh memasukkan gambar'
                ]

            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/berita/create')->withInput()->with('validation', $validation);
            return redirect()->to('/create')->withInput();
        }

        $sampul = $this->request->getFile('sampul');
        $namaSampul = $sampul->getRandomName();
        $sampul->move('img', $namaSampul);

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->beritaModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'isi' => $this->request->getVar('isi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Berita Ditambahkan');
        return redirect()->to('/');
    }

    public function delete($id)
    {
        $berita = $this->beritaModel->find('id');
        //unlink('img/' . $berita['sampul']);
        $this->beritaModel->delete($id);
        session()->setFlashdata('pesan', 'Berita Dihapus');
        return redirect()->to("/");
    }

    public function edit($slug)
    {
        $data = [
            'judul' => 'ubah berita',
            'validation' => \Config\Services::validation(),
            'berita' => $this->beritaModel->getAllBerita($slug)
        ];

        return view('berita/editBerita', $data);
    }

    public function update($id)
    {
        $isiLama = $this->beritaModel->getAllBerita($this->request->getVar('slug'));
        if ($isiLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[berita.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'pilih gambar dibawah 2 MB',
                    'is_image' => 'hanya boleh memasukkan gambar',
                    'mime_in' => 'hanya boleh memasukkan gambar'
                ]

            ]
        ])) {
            return redirect()->to('/berita/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $sampul = $this->request->getFile('sampul');
        if ($sampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $sampul->getRandomName();
            $sampul->move('img', $namaSampul);
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->beritaModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'isi' => $this->request->getVar('isi'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Berita Diubah');
        return redirect()->to('/');
    }
    //--------------------------------------------------------------------

}
