<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['kelas_m', 'ruang_m']);
	}

	public function index()
	{
		$kelas = $this->kelas_m->get();
		return $this->twig->display('kelas/index', compact('kelas'));
	}

	public function tambah()
	{
		if (isset($_POST['simpan'])) {
			$kelas = $this->kelas_m->create($_POST);
			redirect('/kelas');
		} else {
			return $this->twig->display('kelas/create');
		}
	}

	public function tampil($id)
	{
		$kelas = $this->kelas_m->find($id);
		return $this->twig->display('kelas/tampil', compact('kelas'));
	}

	public function edit($id)
	{
		$kelas = $this->kelas_m->find($id);
		$ruang = $this->ruang_m->get();
		if (isset($_POST['simpan'])) {
			$kelas->update($_POST);
			$kelas->ruang()->sync($_POST['ruang']);
			redirect('/kelas/tampil/'.$kelas->id);
		} else {
			return $this->twig->display('kelas/edit', compact('kelas', 'ruang'));
		}
	}

	public function hapus($id)
	{
		$kelas = $this->kelas_m->destroy($id);
		redirect('/kelas');
	}
}