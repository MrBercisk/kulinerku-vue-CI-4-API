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
                    'kode' => $this->request->getVar('kode'),
                    'nama' => $this->request->getVar('nama'),
                    'harga' => $this->request->getVar('harga'),
                    'gambar' => $gambarName,
                    'is_ready' => $this->request->getVar('is_ready')
                ]);

                return $this->respondCreated('Data Berhasil Ditambahkan', $data, 201);
            } else {
                return $this->respond(['error' => 'File gambar tidak valid'], 400);
            }
        }
    }
    public function update($id = null)
    {
        $product = $this->products->find($id);

        if (!$product) {
            return $this->failNotFound('Makanan tidak ditemukan');
        }

        $gambar = $this->request->getFile('gambar');
        $gambarName = $product['gambar']; // Simpan nama gambar saat ini sebagai default

        if ($gambar) {
            // Jika ada file gambar yang diupload
            $gambarName = $gambar->getRandomName();
            $gambar->move('upload', $gambarName);

            // Hapus gambar lama jika ada
            if (is_file(WRITEPATH . 'upload/' . $product['gambar'])) {
                unlink(WRITEPATH . 'upload/' . $product['gambar']);
            }
        }

        // Update data produk
        $data = [
            'id' => $id,
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'gambar' => $gambarName,
            'is_ready' => $this->request->getVar('is_ready')
        ];

        // Lakukan pembaruan data produk
        $this->products->save($data);

        return $this->respondUpdated('Data Berhasil Diupdate', 200);
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
