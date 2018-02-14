<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Iuran_m extends Model
{
	protected $table = 'iuran';
	protected $fillable = ['kategori', 'jumlah'];
	public $timestamps = false;

	public function kelas()
	{
		return $this->belongsToMany(Kelas_m::class, 'kelas_iuran', 'iuran_id', 'kelas_id');
	}
}