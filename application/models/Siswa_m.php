<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Siswa_m extends Model
{
	protected $table = 'siswa';
	protected $fillable = ['nisn', 'nama', 'tahun', 'kelas_id', 'ruang_id'];
	protected $hidden = ['kelas_id', 'ruang_id'];
	public $timestamps = false;

	public function kelas()
	{
		return $this->belongsTo(Kelas_m::class);
	}

	public function ruang()
	{
		return $this->belongsTo(Ruang_m::class);
	}

	public function wali()
	{
		return $this->belongsTo(Guru_m::class);
	}

	public function status()
	{
		return $this->hasMany(Status_m::class, 'siswa_id', 'id');
	}
}