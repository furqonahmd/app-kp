<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['guru_m', 'user_m', 'ruang_m', 'kelas_m']);
	}

	public function index()
	{
		$guru = $this->guru_m->with('user', 'kelas', 'ruang', 'siswas')->get();
		return $this->twig->display('guru/index', compact('guru'));
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
		$this->form_validation->set_rules('nama', 'NAMA', 'required');
		$this->form_validation->set_rules('kelas_id', 'KELAS', 'required');
		$this->form_validation->set_rules('ruang_id', 'RUANG', 'required');
		if (isset($_POST['simpan']) && ($this->form_validation->run() == true)) {
			$user = $this->user_m->create(['grup' => 'wali', 'password' => md5('wali')]);
			$_POST['user_id'] = $user->id;
			$guru = $this->guru_m->create($_POST);
			$this->session->set_flashdata('message', 'Data Berhasil Disimpan');
			redirect('/guru');
		} else {
			$ruang = $this->ruang_m->get();
			$kelas = $this->kelas_m->get();
			return $this->twig->display('guru/create', compact('ruang', 'kelas'));
		}
	}

	public function tampil($id)
	{
		$guru = $this->guru_m->find($id);
		return $this->twig->display('guru/tampil', compact('guru'));
	}

	public function edit($id)
	{
		$guru = $this->guru_m->find($id);
		if (isset($_POST['simpan'])) {
			$guru->update($_POST);
			redirect('/guru/tampil/'.$guru->id);
		} else {
			return $this->twig->display('guru/edit', compact('guru'));
		}
	}

	public function hapus($id)
	{
		$guru = $this->guru_m->destroy($id);
		redirect('/guru');
	}

	public function cetak($id)
	{
		$this->load->library('pdf');
		$guru = $this->guru_m->find($id);
		$pdf = $this->pdf;
		$pdf->SetCreator('NANDHIEF');
		$pdf->SetTitle("Siswa :: $guru->nama");
		$pdf->AddPage();
		$html = $this->load->view('guru/cetak', compact('guru'), true);
		$pdf->writeHTML($html, true, false, true, false, '');
		return $pdf->Output("$guru->nama.pdf", 'I');
	}
}