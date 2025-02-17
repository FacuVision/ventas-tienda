<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Computer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        $users = User::all()->count();
        $computers = Computer::all()->count();
        $categories = Category::all()->count();
        return view("admin.index", compact("user", "users","categories","computers"));



    }

}
