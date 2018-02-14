<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['siswa_m', 'kelas_m', 'ruang_m', 'status_m']);
	}

	public function index()
	{
		$siswa = $this->siswa_m->with('wali')->get();
		return $this->twig->display('siswa/index', compact('siswa'));
	}

	public function tambah()
	{
		if (isset($_POST['simpan'])) {
			$siswa = $this->siswa_m->create($_POST);
			foreach ($siswa->kelas->iuran as $iuran) {
				$this->status_m->create(['siswa_id' => $siswa->id, 'iuran_id' => $iuran->id]);
			}
			redirect('/siswa');
		} else {
			$kelas = $this->kelas_m->get();
			$ruang = $this->ruang_m->get();
			return $this->twig->display('siswa/create', compact('kelas', 'ruang'));
		}
	}

	public function tampil($id)
	{
		$siswa = $this->siswa_m->find($id);
		if (count($siswa->status) == 0) {
			foreach ($siswa->kelas->iuran as $iuran) {
				$this->status_m->create(['siswa_id' => $siswa->id, 'iuran_id' => $iuran->id]);
			}
			$siswa = $this->siswa_m->find($id);
		}
		return $this->twig->display('siswa/tampil', compact('siswa'));
	}

	public function edit($id)
	{
		$siswa = $this->siswa_m->find($id);
		$kelas = $this->kelas_m->get();
		$ruang = $this->ruang_m->get();
		if (isset($_POST['simpan'])) {
			$siswa->nama = $_POST['nama'];
			$siswa->tahun = $_POST['tahun'];
			$siswa->kelas_id = $_POST['kelas'];
			$siswa->ruang_id = $_POST['ruang'];
			$siswa->save();
			foreach ($siswa->status->where('status', true) as $status) {
				$status->update(['status' => false]);
			}
			foreach ($_POST['iuran'] as $data) {
				$siswa->status->where('id', $data)->first()->update(['status' => true]);
			}
			redirect('/siswa/tampil/'.$siswa->id);
		} else {
			return $this->twig->display('siswa/edit', compact('siswa', 'kelas', 'ruang'));
		}
	}

	public function hapus($id)
	{
		$siswa = $this->siswa_m->destroy($id);
		redirect('/siswa');
	}

	public function cetak($id)
	{
		$this->load->library('pdf');
		$siswa = $this->siswa_m->find($id);
		$pdf = $this->pdf;
		$pdf->SetCreator('NANDHIEF');
		$pdf->SetTitle("Siswa :: $siswa->nama");
		$pdf->AddPage();
		$html = $this->load->view('siswa/cetak', compact('siswa'), true);
		$pdf->writeHTML($html, true, false, true, false, '');
		return $pdf->Output("$siswa->nama.pdf", 'I');
	}
}