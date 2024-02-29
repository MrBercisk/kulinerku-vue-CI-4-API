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
            return $this->failNotFound('Produk tidak ditemukan');
        }

        // Periksa jika ada file gambar yang diunggah
        if ($gambar = $this->request->getFile('gambar')) {
            // Periksa apakah file gambar valid
            if ($gambar->isValid()) {
                // Pindahkan file gambar yang diunggah ke folder upload
                $gambarName = $gambar->getRandomName();
                $gambar->move('upload', $gambarName);

                // Hapus gambar lama jika ada
                if (is_file(WRITEPATH . 'upload/' . $product['gambar'])) {
                    unlink(WRITEPATH . 'upload/' . $product['gambar']);
                }
            } else {
                return $this->respond(['error' => 'File gambar tidak valid'], 400);
            }
        }

        // Perbarui data produk
        $data = [
            'id' => $id,
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'is_ready' => $this->request->getVar('is_ready')
        ];

        // Jika ada file gambar yang diunggah, tambahkan nama gambar ke dalam data
        if (isset($gambarName)) {
            $data['gambar'] = $gambarName;
        }

        // Lakukan pembaruan produk
        $updated = $this->products->update($id, $data);

        if ($updated) {
            return $this->respondUpdated('Produk berhasil diperbarui', $updated);
        } else {
            return $this->fail('Gagal memperbarui produk', 500);
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
