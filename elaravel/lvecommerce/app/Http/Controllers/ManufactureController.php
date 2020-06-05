<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ManufactureController extends Controller
{
    public function index()
    {
    	return view('admin.add_manufacture');
    }

    public function saveManufacture(Request $request)
    {
      $this->AdminAuthCheck();

   	  $data = array();
      $data['manufacture_id'] = $request->manufacture_id;
      $data['manufacture_name'] = $request->manufacture_name;
      $data['manufacture_description'] = $request->manufacture_description;
      $data['publication_status'] = $request->publication_status;
      $data = DB::table('tbl_manufacture')->insert($data);
      Session::put('message','manufacture Added Successfully');
      return Redirect::to('/add-manufacture');

    }


    public function allManufacture()
    {
      $this->AdminAuthCheck();

   	$all_manufacture_info = DB::table('tbl_manufacture')->get();
   	     $manage_manufacture = view('admin.all_manufacture')
   	             ->with('all_manufacture_info',$all_manufacture_info);
   	         return view('admin_layout')
   	                    ->with('admin.all_manufacture',$manage_manufacture);
    }

    public function unactiveManufacture($manufacture_id)
   {
       DB::table('tbl_manufacture')
                ->where('manufacture_id',$manufacture_id)->update(['publication_status'=>0]);
                Session::put('message','Manufacture Unactive Successfully');
                return Redirect::to('/all-manufacture');
   }


    public function activeManufacture($manufacture_id)
   {
       DB::table('tbl_manufacture')
                ->where('manufacture_id',$manufacture_id)->update(['publication_status'=>1]);
                Session::put('message','Manufacture Active Successfully');
                return Redirect::to('/all-manufacture');
   }

 
   	   public function deleteManufacture($manufacture_id)
   {
            DB::table('tbl_manufacture')
                    ->where('manufacture_id',$manufacture_id)
                    ->delete();
                    Session::get('message','Manufacture Update Successfully');
                    return Redirect::to('/all-manufacture');
   }

   public function editManufacture($manufacture_id)
   {
    $this->AdminAuthCheck();
   	$manufacture_info = DB::table('tbl_manufacture')
                              ->where('manufacture_id',$manufacture_id)
                              ->first();
              //$category_info = DB::table('tbl_category');
   	          $manufacture_info = view('admin.edit_manufacture')
   	                          ->with('manufacture_info',$manufacture_info);
   	          return view('admin_layout')
   	                           ->with('admin.edit_manufacture',$manufacture_info);
   }

   public function updateManufacture(Request $request,$manufacture_id)
   {
             $data = array();
             $data['manufacture_name'] = $request->manufacture_name;
             $data['manufacture_description'] = $request->manufacture_description;

             DB::table('tbl_manufacture')
                     ->where('manufacture_id',$manufacture_id)
                     ->update($data);
                      Session::get('message','Manufacture Update Successfully');
                      return Redirect::to('/all-manufacture');
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
