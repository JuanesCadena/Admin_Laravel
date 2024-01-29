<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(10); // Obtener todos los usuarios
        return view('admin.users.index', compact('users'));
    }
}
