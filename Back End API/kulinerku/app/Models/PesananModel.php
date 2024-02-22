<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
	protected $table = "pesanan";
	protected $allowedFields = ['id','keranjang_id', 'nama', 'no_meja', 'created_at', 'updated_at'];
	protected $primaryKey = 'id';
	protected $column_search = ['keranjang_id', 'nama', 'no_meja'];
	protected $column_order = [null, 'keranjang_id', 'nama', 'no_meja', null];
	protected $order = ['pesanan.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;

	
}
