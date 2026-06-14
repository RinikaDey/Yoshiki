<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function users(Request $request)
    {
        $users = User::when($request->search, function ($query, $search) {

        $query->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('phoneno', 'LIKE', "%{$search}%")
              ->orWhere('address1', 'LIKE', "%{$search}%");

        })->get();

        return view('Admin.users.index', compact('users'));
    }
    public function viewUser($id)
    {
        $users = User::find($id);
        return view('Admin.users.view', compact('users'));
    }

}
