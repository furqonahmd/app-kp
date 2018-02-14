<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Ruang_m extends Model
{
	protected $table = 'ruang';
	protected $fillable = ['ruang'];
	public $timestamps = false;

	public function kelas()
	{
		return $this->belongsToMany(Kelas_m::class, 'kelas_ruang', 'ruang_id', 'kelas_id');
	}
}