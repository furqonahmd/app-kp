<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iuran extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['iuran_m', 'kelas_m']);
	}

	public function index()
	{
		$iuran = $this->iuran_m->get();
		return $this->twig->display('iuran/index', compact('iuran'));
	}

	public function tambah()
	{
		if (isset($_POST['simpan'])) {
			$iuran = $this->iuran_m->create($_POST);
			$iuran->kelas()->sync($_POST['kelas']);
			redirect('/iuran');
		} else {
			$kelas = $this->kelas_m->get();
			return $this->twig->display('iuran/create', compact('kelas'));
		}
	}

	public function tampil($id)
	{
		$iuran = $this->iuran_m->find($id);
		return $this->twig->display('iuran/tampil', compact('iuran'));
	}

	public function edit($id)
	{
		$iuran = $this->iuran_m->find($id);
		$kelas = $this->kelas_m->get();
		if (isset($_POST['simpan'])) {
			$iuran->update($_POST);
			$iuran->kelas()->sync($_POST['kelas']);
			redirect('/iuran/tampil/'.$iuran->id);
		} else {
			return $this->twig->display('iuran/edit', compact('iuran', 'kelas'));
		}
	}

	public function hapus($id)
	{
		$iuran = $this->iuran_m->destroy($id);
		redirect('/iuran');
	}
}