<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
	protected $encrypter;
	protected $form_validation;
	protected $user;
	protected $session;


	public function __construct()
	{
		$this->encrypter = \Config\Services::encrypter();
		$this->form_validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->user = new UserModel();
	}

	public function index()
	{
		$data['title'] = "BSpa | Login";
		return view('v_login/index', $data);
	}

	public function create()
	{
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		if(empty($email) || empty($password)){
			return $this->fail("Email dan Password harus diisi", 400);
		}

		$user = $this->user->where('email', $email)->first();

		/* Cek user ada atau tidak */
		if($user){
			return $this->failNotFound("User tidak ditemukan");
		}

		/* Cek cocok password */
		if(!password_verify($password, $user['password'])){
			return $this->fail("Email atau password salah");
		}

	
		/* Jika valid */
		$data = [
			'id' => $user['id'],
			'email' => $user['email'],
		];
		return $this->respondCreated(['message' => 'Login successful', 'data' => $data]);

	}


	public function logout()
	{
		$this->session->destroy();
		return redirect()->to('login');
	}
}
