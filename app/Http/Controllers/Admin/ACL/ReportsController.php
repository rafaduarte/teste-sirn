<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:reports']);
    }
    public function index() {
        return view('admin.reports.index');
        
    }
}
