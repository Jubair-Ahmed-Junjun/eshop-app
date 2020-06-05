<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function AddSlider()
    {
    	return view('admin.add_slider');
    }

    public function SaveSlider(Request $request)
    {
        $data = array();
    	$data['publication_status'] = $request->publication_status;
    	$image = $request->file('slider_image');
    	if ($image) {
    		$image_name = str_random(20);
    		$ext = strtolower($image->getClientOriginalExtension());
    		$image_full_name = $image_name.'.'.$ext;
    		$upload_path = 'slider/';
    		$image_url = $upload_path.$image_full_name;
    		$success = $image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['slider_image'] = $image_url;
    			DB::table('tbl_slider')->insert($data);
    			Session::put('message','Slider Added Successfully!!');
    			return Redirect::to('/add-slider');

           }
             $data['slider_image'] = '';
    			DB::table('tbl_slider')->insert($data);
    			Session::put('message','Slider Added Without Image!!');
    			return Redirect::to('/add-slider');
           }
}

public function allSlider()
{
	$all_slider = DB::table('tbl_slider')->get();
   	     $manage_slider = view('admin.all_slider')
   	             ->with('all_slider',$all_slider);
   	         return view('admin_layout')
   	                    ->with('admin.all_slider',$manage_slider);
}
  public function unactiveSlider($slider_id)
   {
       DB::table('tbl_slider')
                ->where('slider_id',$slider_id)->update(['publication_status'=>0]);
                Session::put('message','Slider Unactive Successfully');
                return Redirect::to('/all-slider');
   }


    public function activeSlider($slider_id)
   {
       DB::table('tbl_slider')
                ->where('slider_id',$slider_id)->update(['publication_status'=>1]);
                Session::put('message','Slider Active Successfully');
                return Redirect::to('/all-slider');
   }

   public function deleteSlider($slider_id)
   {
   	DB::table('tbl_slider')
                    ->where('slider_id',$slider_id)
                    ->delete();
                    Session::get('message','Slider Update Successfully');
                    return Redirect::to('/all-slider');
   }
}