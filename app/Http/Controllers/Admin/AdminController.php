<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return view('admin.login');
        }

//        // Доступ к текущему пользователю
//        $user = auth()->user();
//
////        return response()->json(['user' => $user]);
        return view('admin.index');
    }
}
