<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"crossorigin="anonymous">
<style>
table{
    width:100%;
}
#example_filter{
    float:right;
}
#example_paginate{
    float:right;
}
label {
    display: inline-flex;
    margin-bottom: .5rem;
    margin-top: .5rem;
   
}

</style>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
			{{ __('Add Product') }} 
			<div class="float-right">
				<a href="{{ url('home') }}"><button class="btn btn-primary"> <i class="fas fa-history"></i> </button> </a>
			</div>

		 </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


		    @if ($errors->any())
		    <div class="alert alert-danger">
		        <strong>Whoops!</strong> There were some problems with your input.<br><br>
			        <ul>
			            @foreach ($errors->all() as $error)
			                    <li>{{ $error }}</li>
		                    @endforeach
				</ul>
		    </div>
		    @endif

<form method="post" name="productAdd" id="productAdd" action="{{ route('product.store') }}" enctype="multipart/form-data">
@csrf
  <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Product Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="productName" id="productName" placeholder="Product Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="productPrice" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="productPrice" id="productPrice" placeholder="Price">
    </div>
  </div>
  <div class="form-group row">
    <label for="productUpc" class="col-sm-2 col-form-label">UPC</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="productUPC" id="productUPC" placeholder="UPC">
    </div>
  </div>
  <div class="form-group row">
    <label for="productImage" class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-10">
      <input type="file" class="form-control" name="productImage" id="productImage">
    </div>
  </div>
	  <div class="form-group row text-right">
    <div class="col-sm-12">
      <button type="reset" class="btn btn-danger" name="productReset" id="productReset">Reset</button> &nbsp;
      <button type="submit" class="btn btn-primary" name="productSubmit" id="productSubmit">Submit</button>
    </div>
  </div>

</form>


               	 
</div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
$(document).ready(function() {
    $('#example').DataTable(
        
         {     

      "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
       } 
        );
} );


function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
</script>
