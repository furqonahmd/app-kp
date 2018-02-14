<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['User_m']);
	}

	public function login()
	{
		if (!auth()) {
			return $this->twig->display('auth/login');
		} else {
			return redirect('/');
		}
	}

	public function authenticate()
	{
		if ($this->input->post()) {
			$post = (object) $this->input->post();
			$user = User_m::whereGrup($post->username)->first();
			if ($user) {
				if (md5($post->password) == $user->password) {
					// if (password_needs_rehash($user->password, PASSWORD_BCRYPT)) {
					// 	$newpass = password_hash($post->password, PASSWORD_BCRYPT);
					// }
					$info = [
							'username' => $user->grup,
							'logged_in' => true
						];
					$this->session->set_userdata($info);
					return $this->login();
				} else {
					return redirect('auth/login?pesan=Password+Salah');
				}
			} else {
				return redirect('auth/login?pesan=Username+Salah');
			}
		} else {
			return show_404();
		}
	}

	public function logout()
	{
		if (auth()) {
			$this->session->unset_userdata(['username', 'logged_in']);
			return redirect('/');
		} else {
			return show_404();
		}
	}
}
