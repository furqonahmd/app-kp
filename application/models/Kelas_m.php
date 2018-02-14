<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Kelas_m extends Model
{
	protected $table = 'kelas';
	protected $fillable = ['kelas'];
	public $timestamps = false;

	public function ruang()
	{
		return $this->belongsToMany(Ruang_m::class, 'kelas_ruang', 'kelas_id', 'ruang_id');
	}

	public function iuran()
	{
		return $this->belongsToMany(Iuran_m::class, 'kelas_iuran', 'kelas_id', 'iuran_id');
	}
}