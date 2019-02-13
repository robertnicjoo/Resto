<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;
use Storage;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware(['role:Manager']);
    }
    
    public function index()
    {
        $users = User::orderby('id', 'desc')->with('roles')->get();
        return view('admin.users.index', compact('users'));
    }
}
