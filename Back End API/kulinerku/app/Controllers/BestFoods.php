<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\BestFoodsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class BestFoods extends ResourceController
{

    protected $products;
    protected $best;
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
        $this->best = new BestFoodsModel();
    }
    public function index()
    {
        $data = $this->best->getAllBestFoods();

        if ($data == null) {
            return $this->fail('Data Tidak Ditemukan', 400);
        }
        return $this->respond($data, 200);
    }
    public function show($id = null)
    {

        $data = $this->best->find($id);
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

                $data = $this->best->insert([
                    'product_id' => $json->product_id
                ]);
            } else {
                $data = $this->best->insert([
                    'product_id' => $this->request->getPost('product_id')
                ]);
            }
            return $this->respondCreated('Data Berhasil Ditambahkan', $data, 201);
        }
        return $this->fail('Gagal tambah data');
    }


    public function delete($id = null)
    {
        $data = $this->best->find($id);

        if ($data) {
            $this->best->delete($id);

            return $this->respondDeleted('Data Berhasil Dihapus');
        }
    }
}
