<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use App\Models\History;
use Illuminate\Http\Request;

class AdminHystoryController extends Controller
{
    public function index(Request $request) {
        return view('admin.history.index', [ 'admin' => AdminMainController::admin() ]);
    }
}
