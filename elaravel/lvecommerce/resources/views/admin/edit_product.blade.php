@extends('admin_layout')
@section('admin_dashboard')
	<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Product</h2>
					</div>
					<div class="box-content">

						<form class="form-horizontal" action="{{url('/update-product',$product_info->product_id)}}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }} 
						  <fieldset>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="form-control" name="product_name" value="{{ $product_info->product_name}}">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Price</label>
							  <div class="controls">
								<input type="text" class="form-control" name="product_price" value="{{ $product_info->product_price}}">
							  </div>
							</div>


                            <div class="control-group">
								<label class="control-label" for="selectError3">Product Category</label>
								<div class="controls">
								  <select id="selectError3" name="category_id">
								  	<option>------Select Category-------</option>
                                   <?php
                                       $all_publication_category=DB::table('tbl_category')
                                     ->where('publication_status',1)
                                     ->get();
                                     foreach ($all_publication_category as $category) {?>
									<option value="{{$category->category_id}}">{{$category->category_name}}</option>

								<?php } ?>
								  </select>
								</div>
							  </div>

							<div class="control-group">
								<label class="control-label" for="selectError3">Product Manufacture</label>
								<div class="controls">
								  <select id="selectError3" name="manufacture_id">
                                 	<option>--------Select Manufacture--------</option>
                                 	 <?php
                                       $all_publication_manufacture=DB::table('tbl_manufacture')
                                     ->where('publication_status',1)
                                     ->get();
                                     foreach ($all_publication_manufacture as $manufacture) {?>
									<option value="{{$manufacture->manufacture_id}}">{{$manufacture->manufacture_name}}</option>

								<?php } ?>
								  </select>
								</div>
							 </div>

                            <div class="control-group">
							  <label class="control-label" for="fileInput">Product Image</label>
							  <div class="controls">
								<input type="file" class="input-file uniform_on" name="product_image">
							  </div>
							</div>


							<div class="col-sm-6 col-xs-6 col-md-6">
                              <div class="form-group">
                               <label>Old Product Image:</label>
                                <img src="{{URL::to($product_info->product_image)}}" style="height: 70px; width: 80px;">
                                 <input type="hidden" name="old_image" value="{{$product_info->product_image}}">
                              </div>
                             </div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary form-control">Update</button>
							 
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->


@endsection