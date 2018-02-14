<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['guru_m', 'siswa_m', 'kelas_m', 'ruang_m', 'status_m', 'iuran_m']);
		if (!auth()) {
			return redirect('auth/login');
		}
	}

	public function index()
	{
		$guru = $this->guru_m->with(['kelas', 'ruang'])->whereNotNull('kelas_id')->whereNotNull('ruang_id')->get();
		return $this->twig->display('dashboard', compact('guru'));
	}

	public function cetak()
	{
		$data = $this->guru_m->with(['kelas', 'ruang', 'siswas'])->whereNip($this->input->post('kelas'))->first();
		$filename = 'Data Siswa Kelas ' . $data->kelas->kelas . $data->ruang->ruang . '.pdf';
		$this->load->library('pdf');
		$pdf = $this->pdf;
		$pdf->SetCreator('NANDHIEF');
		$pdf->SetTitle("Data Siswa kelas");
		$pdf->AddPage();
		// return $this->load->view('cetak', compact('data'));
		$html = $this->load->view('cetak', compact('data'), true);
		$pdf->writeHTML($html, true, false, true, false, '');
		return $pdf->Output($filename, 'I');

	}

	public function test()
	{
		$this->load->library('pdf');
		$siswa = $this->siswa_m->get();
		$iuran = $this->iuran_m->get();
		$pdf = $this->pdf;
		$pdf->SetCreator('NANDHIEF');
		$pdf->SetTitle("Data Siswa");
		$pdf->AddPage();
		// return $this->load->view('cetak', compact('siswa', 'iuran'));
		$html = $this->load->view('cetak', compact('siswa', 'iuran'), true);
		$pdf->writeHTML($html, true, false, true, false, '');
		return $pdf->Output("Test.pdf", 'I');
	}

	public function dump()
	{
		foreach (range(1,25) as $r) {
			$data = (object) collect([['tahun' => 2015, 'kelas' => 3], ['tahun' => 2016, 'kelas' => 2], ['tahun' => 2017, 'kelas' => 1], ])->random();
			$siswa = $this->siswa_m->create([
				'nisn' => $this->siswa_m->orderBy('nisn', 'desc')->first()->nisn+1,
				'nama' => fullname(),
				'tahun' => $data->tahun,
				'kelas_id' => $data->kelas,
				'ruang_id' => rand(1,4),
			]);
			foreach ($siswa->kelas->iuran as $iuran) {
				$this->status_m->create(['siswa_id' => $siswa->id, 'iuran_id' => $iuran->id]);
			}
			dump($siswa->nisn . ' - ' . $siswa->nama);
		}
		return 'Selesai';
	}
}
