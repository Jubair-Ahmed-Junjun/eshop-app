<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminCategoryController extends Controller
{
   public function index()
   {
      return view('admin.add_category');
   }
   public function allCategory()
   {
    $this->AdminAuthCheck();

   	$all_category_info = DB::table('tbl_category')->get();
   	     $manage_category = view('admin.all_category')
   	             ->with('all_category_info',$all_category_info);
   	         return view('admin_layout')
   	                    ->with('admin.all_category',$manage_category);
   	//return view('admin.all_category');
   }
   public function saveCategory(Request $request)
   {
   	  $data = array();
      $data['category_id'] = $request->category_id;
      $data['category_name'] = $request->category_name;
      $data['category_description'] = $request->category_description;
      $data['publication_status'] = $request->publication_status;

      $data = DB::table('tbl_category')->insert($data);
      Session::put('message','Category Added Successfully');
      return Redirect::to('/add-category');
    
   }

   public function unactiveCategory($category_id)
   {
       DB::table('tbl_category')
                ->where('category_id',$category_id)->update(['publication_status'=>0]);
                Session::put('message','Category Unactive Successfully');
                return Redirect::to('/all-category');
   }


    public function activeCategory($category_id)
   {
       DB::table('tbl_category')
                ->where('category_id',$category_id)->update(['publication_status'=>1]);
                Session::put('message','Category Active Successfully');
                return Redirect::to('/all-category');
   }

   public function editCategory($category_id)
   {
       $this->AdminAuthCheck();
              $category_info = DB::table('tbl_category')
                              ->where('category_id',$category_id)
                              ->first();
              //$category_info = DB::table('tbl_category');
   	          $category_info = view('admin.edit_category')
   	                          ->with('category_info',$category_info);
   	          return view('admin_layout')
   	                           ->with('admin.edit_category',$category_info);
   	                   
   }

   public function updateCategory(Request $request,$category_id)
   {
             $data = array();
             $data['category_name'] = $request->category_name;
             $data['category_description'] = $request->category_description;

             DB::table('tbl_category')
                     ->where('category_id',$category_id)
                     ->update($data);
                      Session::get('message','Category Update Successfully');
                      return Redirect::to('/all-category');
   }

   public function deleteCategory($category_id)
   {
            DB::table('tbl_category')
                    ->where('category_id',$category_id)
                    ->delete();
                    Session::get('message','Category Update Successfully');
                    return Redirect::to('/all-category');
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