@extends('layouts.admin.entreprises')

@section('content')
                
   <div class="row">
   	
   	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>Name</th>
	      <th>Description</th>
	      <th>Time</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($entreprises as $entreprise)
	  	
	  		<tr>
	     		<td>
	     		<a href="#">{{$entreprise->name}}</a>
	     		<div>
	     			<a href="'{{route('entreprise.accept', $entreprise->id)}}" class="btn btn-primary btn-xs accept"><span class="glyphicon glyphicon-ok"></span></a>
	     			<a href="#" class="btn btn-primary btn-xs refuse"><span class="glyphicon glyphicon-remove"></span></a>
	     		</div>
	     		</td>
	     		
	     		<td>{{$entreprise->description}}</td>
	     		<td>{{$entreprise->created_at}}</td>
	    	</tr>
	    
	  	@endforeach
	  </tbody>
	</table>

   </div>

@endsection

@section('scripts')

<script>

$('.accept').on('click', function(event){
	event.preventDefault();
	console.log(event);

	$.ajax({
		method: 'POST',
		url: this.href,
		data: {_token: {{Session::token()}} }
	})
	.done(function(msg){
		console.log(msg['message']);
	});

});

</script>

@endsection