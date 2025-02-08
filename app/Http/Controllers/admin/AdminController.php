<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $visitors = Visitor::with('user')->get();
        return view('admin.dashboard', compact('visitors'));
    }
}
