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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
			{{ __('Product Dashboard') }} 
			<div class="float-right">
				<a href="{{ url('product/create') }}"> <button class="btn btn-primary"><i class="fas fa-plus"></i> </button></a>
				<button class="btn btn-danger" id="deleteMulti"><i class="fas fa-trash"></i> </button>
			</div>

		 </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif


<table id="example" class="table table-striped table-bordered">
    <thead>
	<tr>
	    <td><input type="checkbox" onclick="checkAll(this)"></td>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>shark Level</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($prodData as $key => $value)
        <tr>
	    <td><input type="checkbox" name="prodChk" id="chk_{{ $value->id }}" value="{{ $value->id }}"></td>
	    <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->price }}</td>
            <td>{{ $value->upc }}</td>
            <td>

		<button class="btn btn-sm btn-primary" href="{{ URL::to('product/' . $value->id . '/edit') }}">Edit</button> &nbsp;

		<form action="{{ route('product.destroy', $value->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                  </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
                
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
    });

   $('#deleteMulti').click(function(e){
	var chArray = [];
            $.each($("input[name='prodChk']:checked"), function(){
                chArray.push($(this).val());
            });
		if(chArray.length == 0){
			alert("Please select product(s)")
		}else{
			$.ajax({
                        type:'POST',
                        url:'/getmsg',
                        data: {"_token": <?php echo csrf_token() ?>, 'id': chArray.join(", ")},
                       success:function(data) {
                          alert(data);
                        }
                    });
		} // else End	
   }); // deleteMulti End

});


function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
</script>
