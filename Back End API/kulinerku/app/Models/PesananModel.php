<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
	protected $table = "pesanan";
	protected $allowedFields = ['id','product_id', 'jumlah_pesan', 'keterangan', 'created_at', 'updated_at'];
	protected $primaryKey = 'id';
	protected $column_search = ['product_id', 'jumlah_pesan', 'keterangan'];
	protected $column_order = [null, 'product_id', 'jumlah_pesan', 'keterangan', null];
	protected $order = ['pesanan.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;


}
