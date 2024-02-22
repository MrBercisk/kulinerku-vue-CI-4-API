<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Products extends ResourceController
{

    protected $products;
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
        $this->products = new ProductsModel();
    }
    public function index()
    {
        $data = $this->products->orderBy('id', 'desc')->findAll();

        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }
    public function show($id = null)
    {

        $data = $this->products->find($id);
        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }

    public function create()
    {
        if ($this->request) {
            $gambar = $this->request->getFile('gambar');

            if ($gambar->isValid()) {
                $gambarName = $gambar->getRandomName();
                $gambar->move('upload', $gambarName);

                $data = $this->products->insert([
                    'kode' => $this->request->getPost('kode'),
                    'nama' => $this->request->getPost('nama'),
                    'harga' => $this->request->getPost('harga'),
                    'gambar' => $gambarName,
                    'is_ready' => $this->request->getPost('is_ready')
                ]);

                return $this->respondCreated('Data Berhasil Ditambahkan', $data);
            } else {
                return $this->respond(['error' => 'File gambar tidak valid'], 400);
            }
        }
    }
    public function update($id = null)
    {
        if ($this->request) {
            if ($this->request->getJSON()) {
                $json = $this->request->getJSON();

                $data = $this->update($json->id, [
                    'kode' => $json->kode,
                    'nama' => $json->nama,
                    'harga' => $json->harga,
                    'gambar' => $json->gambar,
                    'is_ready' => $json->is_ready,
                ]);
            } else {
                $product = $this->request->getRawInput();
                $data = $this->update($id, $product);
            }

            return $this->respondUpdated('Data Berhasil Diupdate', $data, 200);
        }
    }

    public function delete($id = null)
    {
        $data = $this->products->find($id);

        if ($data) {
            $this->products->delete($id);

            return $this->respondDeleted('Data Berhasil Dihapus');
        }
    }
}
