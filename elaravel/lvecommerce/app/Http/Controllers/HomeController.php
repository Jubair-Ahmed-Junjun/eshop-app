<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index()
    { 

     $all_product_published_info = DB::table('tbl_product')
                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                ->where('tbl_product.publication_status',1)
                ->limit(9)
                ->get();


        $manage_published_product = view('pages.home_content')
                        ->with('all_product_published_info',$all_product_published_info);
                   return view('layout')
                        ->with('pages.home_content',$manage_published_product);
                        //return view('pages.home_content');
    }

    public function product_by_category($category_id)
    {

  

      
         $product_by_category = DB::table('tbl_product')
                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                ->select('tbl_product.*','tbl_category.category_name')
                ->where('tbl_category.category_id',$category_id)
                ->where('tbl_product.publication_status',1)
                ->limit(18)
                ->get();


        $manage_product_by_category = view('pages.product_by_category')
                        ->with('product_by_category',$product_by_category);
                   return view('layout')
                        ->with('pages.product_by_category',$manage_product_by_category);
    	
    }


    public function product_by_manufacture($manufacture_id)
    {

         $product_by_manufacture = DB::table('tbl_product')
                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id') 
                ->select('tbl_product.*','tbl_category.category_name')
                ->where('tbl_manufacture.manufacture_id',$manufacture_id)
                ->where('tbl_product.publication_status',1)
                ->limit(18)
                ->get();


        $manage_product_by_manufacture = view('pages.product_by_manufacture')
                        ->with('product_by_manufacture',$product_by_manufacture);
                   return view('layout')
                        ->with('pages.product_by_manufacture',$manage_product_by_manufacture);
    }

    public function product_details_by_id($product_id)
    {
         $product_details_by_id= DB::table('tbl_product')
                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                ->where('tbl_product.product_id',$product_id)
                ->where('tbl_product.publication_status',1)
                ->first();


        $manage_product_details_by_id = view('pages.product_details')
                        ->with('product_details_by_id',$product_details_by_id);
                   return view('layout')
                        ->with('pages.product_details',$manage_product_details_by_id);
    }
 }

