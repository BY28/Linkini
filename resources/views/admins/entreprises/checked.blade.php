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
	     			<a href="#" class="btn btn-primary btn-xs check">Check</a>
	     			<a href="#" class="btn btn-primary btn-xs refuse">Refuse</a>
	     		</td>
	    	</tr>
	    
	  	@endforeach
	  </tbody>
	</table>

   </div>

@endsection

@section('scripts')

<script>

$('.check').click(function(event)
{
    event.preventDefault();
    
    var token = '{{Session::token()}}';
    var urlAccept = '{{route('entreprise.check')}}';

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