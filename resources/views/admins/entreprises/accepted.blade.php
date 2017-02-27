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
	  	
	  		<tr data-entrepriseid="{!! $entreprise->id !!}">
	     		<td>
	     		<a href="#">{{$entreprise->name}}</a>
	     		</td>
	     		
	     		<td>{{$entreprise->description}}</td>
	     		<td>{{$entreprise->created_at}}</td>
	     		<td>
	     			<a href="#" class="btn btn-primary btn-xs accept"><span class="glyphicon glyphicon-ok"></span></a>
	     			<a href="#" class="btn btn-primary btn-xs refuse"><span class="glyphicon glyphicon-remove"></span></a>
	     		</td>
	    	</tr>
	    
	  	@endforeach
	  </tbody>
	</table>

   </div>

@endsection

@section('scripts')

<script>

$('.accept').click(function(event)
{
    event.preventDefault();
    
    var token = '{{Session::token()}}';
    var urlAccept = '{{route('entreprise.accept')}}';

    var entrepriseId = event.target.parentNode.parentNode.dataset['entrepriseid'];

    $.ajax({
        method: 'POST',
        url: urlAccept,
        data: {entrepriseId: entrepriseId, _token: token}

    })
    .done(function(){
        event.target.parentNode.parentNode.remove();
    });
});

</script>

@endsection