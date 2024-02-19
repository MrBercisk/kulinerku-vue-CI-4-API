<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
	protected $table = "products";
	protected $allowedFields = ['id','kode', 'nama', 'harga', 'gambar', 'is_ready'];
	protected $primaryKey = 'id';
	protected $column_search = ['kode', 'nama', 'harga', 'gambar', 'is_ready'];
	protected $column_order = [null, 'kode', 'nama', 'harga', 'gambar', 'is_ready', null];
	protected $order = ['products.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;


}
