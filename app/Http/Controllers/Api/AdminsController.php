<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminsController extends Controller
{
	/**
	 * 获取所有管理员信息
	 */
	public function index()
	{
		return response()->json(User::Role('admin')->paginate());
    }
}
