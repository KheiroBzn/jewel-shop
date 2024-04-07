<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminMainController;
use Illuminate\Http\Request;

class AdminStatisticController extends Controller
{
    public function index(Request $request) {
        return view('admin.statistics.index', [ 'admin' => AdminMainController::admin() ]);
    }
}
