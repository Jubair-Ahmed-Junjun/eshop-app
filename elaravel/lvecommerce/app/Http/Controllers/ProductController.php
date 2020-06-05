<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductController extends Controller
{
    public function index()
    {
       return view('admin.add_product');
    }

    public function allProduct()
    {
      $this->AdminAuthCheck();
        $all_product_info = DB::table('tbl_product')
                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                ->get();
                         // echo "<pre>";
                         // echo $all_product_info;
                         // echo "</pre>";
                         // exit();
                          


        $manage_product = view('admin.all_product')
                        ->with('all_product_info',$all_product_info);
                   return view('admin_layout')
                        ->with('admin.all_product',$manage_product);
    }

    public function saveProduct(Request $request)
    {
      $this->AdminAuthCheck();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['category_id'] = $request->category_id;
    	$data['manufacture_id'] = $request->manufacture_id;
    	$data['product_short_description'] = $request->product_short_description;
    	$data['product_long_description'] = $request->product_long_description;
    	$data['product_price'] = $request->product_price;
    	$data['product_size'] = $request->product_size;
    	$data['product_color'] = $request->product_color;
    	$data['publication_status'] = $request->publication_status;
    	$image = $request->file('product_image');
    	if ($image) {
    		$image_name = date('dmy_H_s_i');
    		$ext = strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path = 'image/';
    		$image_url = $upload_path.$image_full_name;
    		$success = $image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['product_image'] = $image_url;
    			DB::table('tbl_product')->insert($data);
    			Session::put('message','Product Added Successfully!!');
    			return Redirect::to('/add-product');

    			// echo "<pre>";
    			// print_r($data);
    			// echo "</pre>";
    			// exit();
    		}
    	}
    	        $data['product_image'] = '';
    			DB::table('tbl_product')->insert($data);
    			Session::put('message','Product Added Without Image!!');
    			return Redirect::to('/add-product');
    }




      public function unactiveProduct($product_id)
   {
       DB::table('tbl_product')
                ->where('product_id',$product_id)->update(['publication_status'=>0]);
                Session::put('message','Product Unactive Successfully');
                return Redirect::to('/all-product');
   }


    public function activeProduct($product_id)
   {
       DB::table('tbl_product')
                ->where('product_id',$product_id)->update(['publication_status'=>1]);
                Session::put('message','Product Active Successfully');
                return Redirect::to('/all-product');
   }

 
       public function deleteProduct($product_id)
   {
            DB::table('tbl_product')
                    ->where('product_id',$product_id)
                    ->delete();
                    Session::get('message','Product Delete Successfully');
                    return Redirect::to('/all-product');
   }

   public function editProduct($product_id)
   {
    //$this->AdminAuthCheck();
        $product_info = DB::table('tbl_product')
                              ->where('product_id',$product_id)
                              ->first();
              //$category_info = DB::table('tbl_category');
              $product_info = view('admin.edit_product')
                              ->with('product_info',$product_info);
              return view('admin_layout')
                               ->with('admin.edit_product',$product_info);
   }

  public function updateProduct(Request $request,$product_id)
    {
        $oldimage = $request->old_image;
        
        $data = array();

      $data['product_name'] = $request->product_name;
      $data['product_price'] = $request->product_price;
      $data['category_name'] = $request->category_name;
      $data['manufacture_name'] = $request->manufacture_name;
      $image = $request->file('product_image');
      if($image){
        unlink($oldimage);
       $image_name = date('dmy_H_s_i');
        $ext = strtolower($image->getClientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'image/';
        $image_url = $upload_path.$image_full_name;

        $success = $image->move($upload_path,$image_full_name);
        $data['product_image'] = $image_url;

        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        return redirect()->route('admin.all_product')->with('success','Product Update Successfully');
      }

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
