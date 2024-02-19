<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = "user";
	protected $allowedFields = ['id', 'role_id', 'nama', 'email', 'password'];
	protected $primaryKey = 'id';
	protected $column_search = ['nama', 'email'];
	protected $column_order = [null, 'nama', 'email', null];
	protected $order = ['user.id' => 'desc'];
	protected $useTimestamps = true;
	protected $request;
	protected $session;
	protected $db;
	protected $dt;


}
