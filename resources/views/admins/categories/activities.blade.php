@extends('layouts.admin.index')

@section('content')
<div class="row">
   <div class="col-md-offset-3 col-md-6">
   <br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Ajouter une activité</div>
			<div class="panel-body"> 
   					<h1>{{$category->name}}</h1>
   					{!! Form::open(['route' => 'activities.store', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ajouter une activité']) !!}
						{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
					</div>
					{!! Form::hidden('category_id', $category->id) !!}
					{!! Form::submit('Ajouter', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!} 
			</div>		
		</div>
   </div>
</div>
   <div class="row">
   	
   	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>Name</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($category->activities as $activity)
	  	
	  		<tr class="cat-row" data-activityid="{!! $activity->id !!}">
	     		<td>
	     		<a href="#" class="edit" data-toggle="modal" 
   data-target="#editModal">{{$activity->name}}</a>
	     		</td>
	     		<td>
	     			<a href="#" class="btn btn-danger btn-xs delete" data-toggle="modal" 
   data-target="#deleteModal">Delete</a>
	     			<a href="route('activity.show', $activity->id)" class="btn btn-warning btn-xs activities">Activities</a>
	     		</td>
	    	</tr>
	    
	  	@endforeach
	  </tbody>
	</table>

   </div>



<!-- Modals -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Edit Activityy</h4>
      </div>
      <div class="modal-body form-group">
        <input type="text" name="name" class="form-control" id="edit-activity">
      </div>
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="button" class="btn btn-primary" id="save-edit">
            Save
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Delete Activityy</h4>
      </div>
      <p> Etes vous sur de vouloir supprimer l'actiité <strong id="delete-activity"></strong> ?</p>
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="button" class="btn btn-primary" id="save-delete">
            Delete
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script>

var activityName = null;
var activityId = null;
var clickEvent = null;

$('.edit').click(function(event) {
	activityName = event.target.innerText;
	activityId = event.target.parentNode.parentNode.dataset['activityid'];
    $("#edit-activity").val(activityName);
    clickEvent = event;
});

    $('#save-edit').click(function(e){
	 	event.preventDefault();
	     
	    var token = '{{Session::token()}}';
	    var urlCat = '{{route('activities.update')}}';
	    activityName = $('#edit-activity').val();


	    $.ajax({
	        method: 'POST',
	        url: urlCat,
	        data: {activityId: activityId, activityName: activityName, _token: token}

	    })
	    .done(function(){

	        event.target.innerText = activityName;
	        activityName = null;
			activityId = null;
			clickEvent = null;
	        $('#editModal').modal('hide');

	    });
	});

$('.delete').click(function(event) {
	
	activityName = event.target.parentNode.parentNode.childNodes[1].innerText;
	activityId = event.target.parentNode.parentNode.dataset['activityid'];
	$("#delete-activity").text(activityName);
	clickEvent = event;
});

    $('#save-delete').click(function(e){
	 	event.preventDefault();
	     
	    var token = '{{Session::token()}}';
	    var urlCat = '{{route('activities.delete')}}';


	    $.ajax({
	        method: 'DELETE',
	        url: urlCat,
	        data: {activityId: activityId,  _token: token}

	    })
	    .done(function(){

	        clickEvent.target.parentNode.parentNode.remove();
	        activityName = null;
			activityId = null;
			clickEvent = null;
	        $('#deleteModal').modal('hide');

	    });
	});
</script>

@endsection