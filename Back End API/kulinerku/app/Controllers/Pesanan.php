<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\PesananModel;
use App\Models\KeranjangModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Pesanan extends ResourceController
{

    protected $products;
    protected $pesanan;
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
        $this->pesanan = new PesananModel();
        $this->keranjang = new KeranjangModel();
    }
    public function index()
    {
        $data = $this->pesanan->orderBy('id', 'desc')->findAll();

        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }
    public function show($id = null)
    {

        $data = $this->pesanan->find($id);
        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }

    public function create()
    {
        if ($this->request->getJSON()) {
            $json = $this->request->getJSON();
    
            $data = $this->pesanan->insert([
                'keranjang_id' => $json->keranjang_id,
                'nama' => $json->nama,
                'no_meja' => $json->no_meja,
                'totalHarga' => $json->totalHarga,
            ]);
            
            if ($data) {
                return $this->respondCreated('Data Berhasil Ditambahkan', $data, 201);
            } else {
                return $this->fail('Gagal menambahkan data pesanan', 500);
            }
        } else {
            return $this->fail('Permintaan harus berupa JSON', 400);
        }
    }
    
    public function delete($id = null)
    {
        $data = $this->pesanan->find($id);

        if ($data) {
            $this->pesanan->delete($id);

            return $this->respondDeleted('Data Berhasil Dihapus');
        }
    }
}
