@extends('layouts.admin.entreprises')

@section('content')
                
   <div class="row">
   	
   	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>Nom</th>
	      <th>Email</th>
	      <th>Tel</th>
	      <th>Addresse</th>
	      <th>Activité</th>
	      <th>Description</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($entreprises as $entreprise)
	  	
	  		<tr data-entrepriseid="{!! $entreprise->id !!}">
	     		<td>
	     		<a href="#">{{$entreprise->name}}</a>
	     		</td>
	     		<td>{{$entreprise->email}}</td>
	     		<td>{{$entreprise->phone}}</td>
	     		<td>{{$entreprise->address}}</td>
	     		<td>{{$entreprise->activity->name}}</td>
	     		<td>{{$entreprise->description}}</td>
	     		<td>
	     			<a href="#" class="btn btn-primary btn-xs check" data-loading-text="<i class='fa fa-refresh fa-spin'></i>">Check</a>
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
    var $this = $(this);
    $this.button('loading');

    var token = '{{Session::token()}}';
    var urlAccept = '{{route('entreprises.check')}}';

    var entrepriseId = event.target.parentNode.parentNode.dataset['entrepriseid'];

    $.ajax({
        method: 'POST',
        url: urlAccept,
        data: {entrepriseId: entrepriseId, _token: token}

    })
    .done(function(){
    	$this.button('reset');
        event.target.parentNode.parentNode.remove();
    });
});

</script>

@endsection