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
					<a href="#">Add Product</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
					</div>
					<div class="box-content">                   
                         <p class="alert-success">
							<?php
							$message = Session::get('message');
							if ($message) {
								   echo $message;
							Session::put('message',null);
							}
						?>
						</p>
                 
						<form class="form-horizontal" action="{{url('/save-product')}}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }} 
						  <fieldset>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Name</label>
							  <div class="controls">
								<input type="text" class="form-control" name="product_name" required="">
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

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Short Description</label>
							  <div class="controls">
								<textarea  class="cleditor" name="product_short_description" rows="3" required=""></textarea>
							  </div>
							</div>  


                            <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Product Long Description</label>
							  <div class="controls">
								<textarea class="cleditor" name="product_long_description" rows="3" required=""></textarea>
							  </div>
							</div>  


                            <div class="control-group">
							  <label class="control-label" for="date01">Product Price</label>
							  <div class="controls">
								<input type="text" class="form-control" name="product_price" required="">
							  </div>
							</div>

                            <div class="control-group">
							  <label class="control-label" for="fileInput">Product Image</label>
							  <div class="controls">
								<input type="file" class="input-file uniform_on" name="product_image" required="">
							  </div>
							</div>

                            <div class="control-group">
							  <label class="control-label" for="date01">Product Size</label>
							  <div class="controls">
								<input type="text" class="form-control" name="product_size" required="">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">Product Color</label>
							  <div class="controls">
								<input type="text" class="form-control" name="product_color" required="">
							  </div>
							</div>


							<div class="control-group">
							  <label class="control-label" for="fileInput">Publication Status</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="publication_status" value="1" type="checkbox" >
							  </div>
							</div>  

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Product</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   
					</div>
				</div><!--/span-->
			</div><!--/row-->
@endsection