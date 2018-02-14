<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;

class User_m extends Model
{
	protected $table = 'users';
	protected $fillable = ['grup', 'password'];
	public $timestamps = false;

	public function guru()
	{
		return $this->hasOne(Guru_m::class, 'guru_id');
	}
}