<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\KeranjangModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Keranjang extends ResourceController
{

    protected $products;
    protected $keranjang;
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
        $this->keranjang = new KeranjangModel();
    }
    public function index()
    {
        $data = $this->keranjang->getAllKeranjang();

        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }
    public function show($id = null)
    {

        $data = $this->keranjang->find($id);
        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }

    public function create()
    {
        if ($this->request) {
            if ($this->request->getJSON()) {
                $json = $this->request->getJSON();

                $data = $this->keranjang->insert([
                    'product_id' => $json->product_id,
                    'jumlah_pesan' => $json->jumlah_pesan,
                    'keterangan' => $json->keterangan,
                ]);
            } else {
                $data = $this->keranjang->insert([
                    'product_id' => $this->request->getPost('product_id'),
                    'jumlah_pesan' => $this->request->getPost('jumlah_pesan'),
                    'keterangan' => $this->request->getPost('keterangan'),
                ]);
            }
            return $this->respondCreated('Data Berhasil Ditambahkan', $data, 201);
        }
    }
  
    public function delete($id = null)
    {
        $data = $this->keranjang->find($id);

        if ($data) {
            $this->keranjang->delete($id);

            return $this->respondDeleted('Data Berhasil Dihapus');
        }
    }
}
