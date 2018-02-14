<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class Tahun_m extends Model
{
	protected $table = 'tahun';
	protected $fillable = ['tahun'];
	public $timestamps = false;

	public function siswa()
	{
		return $this->hasMany(Siswa_m::class, 'id', 'tahun_id');
	}
}