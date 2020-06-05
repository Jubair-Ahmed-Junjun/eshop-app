@extends('admin_layout')
@section('admin_dashboard')
<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Manufacture</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>All Manufacture</h2>

					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Manufacture Id</th>
								  <th>Manufacture Name</th>
								  <th>Manufacture Description</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
                                            
                         <p class="alert-success">
							<?php
							$message = Session::get('message');
							if ($message) {
								   echo $message;
								   Session::put('message',null);
							}
						?>
    						</p>
                          @foreach($all_manufacture_info as $manufacture)
						  <tbody>
							<tr>
								<td>{{$manufacture->manufacture_id}}</td>
								<td class="center">{{$manufacture->manufacture_name}}</td>
								<td class="center">{{$manufacture->manufacture_description}}</td>
								
								<td class="center">
                                
                                @if($manufacture->publication_status==1)
                                    <span class="label label-success">Active</span>
									@else
									<span class="label label-danger">Unactive</span>
									@endif
								</td>
								
								<td class="center">
									@if($manufacture->publication_status==1)
									<a class="btn btn-danger" href="{{URL::to('/unactive-manufacture'.$manufacture->manufacture_id)}}">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
                                     @else
                                     <a class="btn btn-success" href="{{URL::to('/active-manufacture'.$manufacture->manufacture_id)}}">
										<i class="halflings-icon white thumbs-up"></i>  
									 </a>
                                    @endif
									
									<a class="btn btn-info" href="{{URL::to('/edit-manufacture'.$manufacture->manufacture_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-manufacture'.$manufacture->manufacture_id)}}" id="delete">
										<i class="halflings-icon white trash"></i> 
									</a>

								</td>

							</tr>

						  </tbody>
						  @endforeach


					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->



@endsection