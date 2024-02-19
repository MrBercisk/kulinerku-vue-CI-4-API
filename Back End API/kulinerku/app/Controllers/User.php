<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    protected $user;
    protected $format = 'json';
    use ResponseTrait;

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
        $this->user = new UserModel();
    }
    public function index()
    {
        $data = $this->user->findAll();

        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }
    public function show($id = null)
    {

        $data = $this->user->find($id);
        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }
    public function create()
    {
        /* Jika valid */
        $password = $this->request->getVar('password');

        // Hash password menggunakan password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'role_id' => 2,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => $hashedPassword
        ];

        $this->user->insert($data);
    }
    public function delete($id = null)
    {
        $data = $this->user->find($id);

        if ($data) {
            $this->user->delete($id);

            return $this->respondDeleted('Data Berhasil Dihapus');
        }
    }
}
