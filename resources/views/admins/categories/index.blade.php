@extends('layouts.admin.index')

@section('content')
<div class="row">
   <div class="col-md-offset-3 col-md-6">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Ajouter une catégorie</div>
			<div class="panel-body"> 
   					{!! Form::open(['route' => 'categories.store', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ajouter une categorie']) !!}
						{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
					</div>
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
	      <th>Nom</th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($categories as $category)
	  	
	  		<tr class="cat-row" data-categoryid="{!! $category->id !!}">
	     		<td>
	     		<a href="#" class="edit" data-toggle="modal" 
   data-target="#editModal">{{$category->name}}</a>
	     		</td>
	     		<td>
	     			<a href="#" class="btn btn-danger btn-xs delete" data-toggle="modal" 
   data-target="#deleteModal">Delete</a>
	     			<a href="{{route('activities.index', $category->id)}}" class="btn btn-warning btn-xs activities">Activities</a>
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
        id="favoritesModalLabel">Edit Category</h4>
      </div>
      <div class="modal-body form-group">
        <input type="text" name="name" class="form-control" id="edit-cat">
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
        id="favoritesModalLabel">Delete Category</h4>
      </div>
      <p> Etes vous sur de vouloir supprimer la categorie <strong id="delete-cat"></strong> ?</p>
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

$('.edit').click(function(event) {
	var categoryName = event.target.innerText;
	var categoryId = event.target.parentNode.parentNode.dataset['categoryid'];
    $("#edit-cat").val(categoryName);

    $('#save-edit').click(function(e){
	 	event.preventDefault();
	     
	    var token = '{{Session::token()}}';
	    var urlCat = '{{route('categories.update')}}';
	    categoryName = $('#edit-cat').val();


	    $.ajax({
	        method: 'POST',
	        url: urlCat,
	        data: {categoryId: categoryId, categoryName: categoryName, _token: token}

	    })
	    .done(function(){

	         event.target.innerText = categoryName;
	         $('#editModal').modal('hide');

	    });
	});

});

$('.delete').click(function(event) {
	
	var categoryName = event.target.parentNode.parentNode.childNodes[1].innerText;
	var categoryId = event.target.parentNode.parentNode.dataset['categoryid'];
	 $("#delete-cat").text(categoryName);

    $('#save-delete').click(function(e){
	 	event.preventDefault();
	     
	    var token = '{{Session::token()}}';
	    var urlCat = '{{route('categories.delete')}}';


	    $.ajax({
	        method: 'DELETE',
	        url: urlCat,
	        data: {categoryId: categoryId,  _token: token}

	    })
	    .done(function(){

	         event.target.parentNode.parentNode.remove();
	         $('#deleteModal').modal('hide');

	    });
	});

});


</script>

@endsection