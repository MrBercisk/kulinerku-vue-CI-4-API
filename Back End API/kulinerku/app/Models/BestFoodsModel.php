<?php

namespace App\Models;

use CodeIgniter\Model;

class BestFoodsModel extends Model
{
	protected $table = "best_foods";
	protected $allowedFields = ['id','product_id','created_at','updated_at'];
	protected $primaryKey = 'id';
	protected $column_search = ['product_id'];
	protected $column_order = [null, 'product_id', null];
	protected $order = ['best_foods.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;

	public function getAllBestFoods(){
		return $this
		->join('products', 'products.id = best_foods.product_id')
		->select('best_foods.*, products.nama, products.harga, products.gambar')
		->findAll();
	}

}
