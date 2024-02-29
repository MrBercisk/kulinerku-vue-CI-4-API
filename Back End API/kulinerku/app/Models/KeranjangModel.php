<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
	protected $table = "keranjang";
	protected $allowedFields = ['id','product_id', 'jumlah_pesan', 'keterangan', 'created_at', 'updated_at'];
	protected $primaryKey = 'id';
	protected $column_search = ['product_id', 'jumlah_pesan', 'keterangan'];
	protected $column_order = [null, 'product_id', 'jumlah_pesan', 'keterangan', null];
	protected $order = ['keranjang.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;
    
    public function getAllKeranjang()
    {
        return $this
        ->join('products', 'products.id = keranjang.product_id')
        ->select('keranjang.*, products.nama, products.harga, products.gambar')
        ->findAll();
    }
	
    

}
