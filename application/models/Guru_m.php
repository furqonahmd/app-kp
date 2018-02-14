<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Guru_m extends Model
{
	protected $table = 'guru';
	protected $fillable = ['nip', 'nama', 'user_id'];
	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo(User_m::class);
	}

	public function kelas()
	{
		return $this->belongsTo(Kelas_m::class);
	}

	public function ruang()
	{
		return $this->belongsTo(Ruang_m::class);
	}

	public function siswas()
	{
		return $this->hasMany(Siswa_m::class, 'wali_id');
	}
}