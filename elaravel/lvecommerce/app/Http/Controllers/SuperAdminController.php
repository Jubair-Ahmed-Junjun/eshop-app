<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class SuperAdminController extends Controller
{
    public function logout()
    {
    	Session::flush();
    	return Redirect::to('/admin');
    }
    public function index()
    {
    	$this->AdminAuthCheck();
    	return view('admin.admin_dashboard');
    }

    public function AdminAuthCheck()
    {
    	$admin=Session::get('admin_id');
        if($admin)
        {
        	return;
        }else{
        	return Redirect::to('/admin')->send();
        }    
    }

}
