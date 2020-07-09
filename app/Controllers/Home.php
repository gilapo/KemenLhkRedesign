<?php

namespace App\Controllers;

use App\Models\Berita_model;

class Home extends BaseController
{
	protected $beritaModel;
	public function __construct()
	{
		$this->beritaModel = new Berita_model();
	}
	public function index()
	{
		// $isi = $this->model->findAll();
		$data = [
			'judul' => 'kementrian Lingkungan Hidup dan kehutanan',
			'berita' => $this->beritaModel->getBerita()
		];
		return view('home/home', $data);
	}


	//--------------------------------------------------------------------

}
