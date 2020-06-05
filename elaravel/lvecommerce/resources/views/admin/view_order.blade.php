@extends('admin_layout')
@section('admin_dashboard')
<div class="row-fluid sortable">

	<div class="box span6">
		<div class="box header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer Details</h2>
		</div>
		<div class="box-content">
			<table class="table">
				<thead>
					<tr>

						<th>Customer Name</th>
						<th>Mobile</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						@foreach($order_by_id as $order)
						@endforeach
						<td>{{$order->customer_name}}</td>
						<td>{{$order->mobile_number}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="box span6">
		<div class="box header">
			<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping Details</h2>
		</div>
		<div class="box-content">
			<table class="table">
				<thead>
					<tr>
						<th>User Name</th>
						<th>Address</th>
						<th>Mobile</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						@foreach($order_by_id as $order)
						@endforeach
						<td>{{$order->shipping_first_name}}</td>
						<td>{{$order->shipping_address}}</td>
						<td>{{$order->shipping_mobile_number}}</td>
						<td>{{$order->shipping_email}}</td>
                        
					</tr>
				</tbody>
			</table>
		</div>
	</div>

		<div class="box span12">
		<div class="box header">
			<h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>
		</div>
		<div class="box-content" data-original-table>
			<table class="table table-stripad">
				<thead>
					<tr>
						<th>Order Id</th>
						<th>Product Name</th>
						<th>Product Price</th>
						<th>Product Sales Quantity</th>
						<th>Product Sub Total</th>

					</tr>
				</thead>
				<tbody>
					@foreach($order_by_id as $order)
					<tr>
						<td>{{$order->order_id}}</td>
						<td>{{$order->product_name}}</td>
						<td>{{$order->product_price}}</td>
						<td>{{$order->product_sales_quantity}}</td>
						<td>{{$order->product_price*$order->product_sales_quantity}}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">Total with Vat:</td>
						<td><strong>={{$order->order_total}} Tk.</strong></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>


</div>
	
@endsection