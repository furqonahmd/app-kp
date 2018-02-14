<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Status_m extends Model
{
	protected $table = 'status';
	protected $fillable = ['status', 'siswa_id', 'iuran_id'];
	public $timestamps = false;

	public function iuran()
	{
		return $this->belongsTo(Iuran_m::class);
	}

	public function siswa()
	{
		return $this->belongsTo(Siswa_m::class);
	}
}