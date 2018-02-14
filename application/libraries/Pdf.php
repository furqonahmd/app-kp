<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends \TCPDF {

	public function Header()
	{
		// $this->image(base_url('images/header.png'), 30, 5, 150, 0, 'PNG', '', 'M', true, 300, '', false, false, 0, false, false, false);
	}

	public function footer()
	{
		// setlocale(LC_TIME, 'Indonesian');
		// $this->SetY(-60);
		// $this->MultiCell(0, 10, 'DEMAK, '. carbon()->formatLocalized('%d %B %Y'), 0, 'R', 0, 0, '', '', true, 0, false, true, 10, 'M');
		// $this->Ln(12);
		// $this->Ln(12);
		// $this->MultiCell(64, 10, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
		// $this->MultiCell(64, 10, '', 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
		// $this->MultiCell(64, 10, 'NANDHIEF', 0, 'C', 0, 0, '', '', true, 0, false, true, 10, 'M');
	}
}