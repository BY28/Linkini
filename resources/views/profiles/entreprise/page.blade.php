@extends('layouts.panel.entreprise')

@section('content')
<div class="col-sm-6">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">HEADER</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => ['page.update', $header_content[0]->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::text('content_title', $header_content[0]->content_title, ['class' => 'form-control', 'placeholder' => 'Titre...']) !!}
					  	{!! $errors->first('content_title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('content_text', $header_content[0]->content_text, ['class' => 'form-control', 'placeholder' => 'Texte...', 'rows' => '8']) !!}
					  	{!! $errors->first('content_text', '<small class="help-block">:message</small>') !!}
					</div>
						{!! Form::submit('Enregistrer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	</div>

	<div class="col-sm-6">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">A PROPOS</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => ['page.update', $about_content[0]->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::text('content_title', $about_content[0]->content_title, ['class' => 'form-control', 'placeholder' => 'Titre...']) !!}
					  	{!! $errors->first('content_title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('content_text', $about_content[0]->content_text, ['class' => 'form-control', 'placeholder' => 'Texte...', 'rows' => '8']) !!}
					  	{!! $errors->first('content_text', '<small class="help-block">:message</small>') !!}
					</div>
						{!! Form::submit('Enregistrer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	</div>

	<div class="col-sm-12">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">CONTACT</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => ['page.update', $contact_content[0]->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::text('content_title', $contact_content[0]->content_title, ['class' => 'form-control', 'placeholder' => 'Titre...']) !!}
					  	{!! $errors->first('content_title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('content_text', $contact_content[0]->content_text, ['class' => 'form-control', 'placeholder' => 'Texte...', 'rows' => '5']) !!}
					  	{!! $errors->first('content_text', '<small class="help-block">:message</small>') !!}
					</div>
						{!! Form::submit('Enregistrer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	</div>

	<div class="col-sm-12">
		<div class="panel panel-primary">	
			<div class="panel-heading">SERVICES</div>
				<div class="panel-body"> 
					<div class="col-sm-12">
						<a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i></a>
					   	<table class="table table-hover">
						  <tbody>
						  	@foreach($services_content as $service)
						  	
						  		<tr class="cat-row" data-serviceid="{!! $service->id !!}">
						     		<td style='color:#ea5817;'>
						     			{{$service->content_title}}
						     		</td>
						     		<td>
						     			{{$service->content_text}}
						     		</td>
						     		<td>
						     			<a href="#" class="edit btn btn-primary btn-xs" data-toggle="modal" data-target="#editModal">Editer</a>
						     			<a href="#" class="btn btn-danger btn-xs delete" data-toggle="modal" data-target="#deleteModal">Supprimer</a>
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
        id="favoritesModalLabel">Editer le service</h4>
      </div>
      <div class="modal-body form-group">
        <input type="text" name="content_title" class="form-control" id="edit-title">
      </div>
      <div class="modal-body form-group">
        <textarea type="text" name="content_text" class="form-control" id="edit-text" rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="button" class="btn btn-primary" id="save-edit">
            Enregistrer
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Ajouter un service</h4>
      </div>
      {!! Form::open(['route' => ['page.store', 'page_services'], 'method' => 'post', 'class' => 'modal-body form-group', 'id' => 'add_service_form']) !!}
	
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::text('content_title', null, ['class' => 'form-control', 'placeholder' => 'Nom...']) !!}
					  	{!! $errors->first('content_title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('content_title') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('content_text', null, ['class' => 'form-control', 'placeholder' => 'Description...', 'rows' => '5']) !!}
					  	{!! $errors->first('content_text', '<small class="help-block">:message</small>') !!}
					</div>			

      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
        </span>
      </div>
      {!! Form::close() !!}
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
        id="favoritesModalLabel">Supprimer le service</h4>
      </div>
      <p> Etes vous sur de vouloir supprimer le service <strong id="delete-cat"></strong> ?</p>
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

var content_title = null; 
var content_text = null;
var id = null;
var clickEvent = null;

$('.edit').click(function(event) {
	content_title = event.target.parentNode.parentNode.childNodes[1].innerText;
	content_text = event.target.parentNode.parentNode.childNodes[3].innerText;
	id = event.target.parentNode.parentNode.dataset['serviceid'];
    $("#edit-title").val(content_title);
    $("#edit-text").val(content_text);
    clickEvent = event;
});

   $('#save-edit').click(function(e){
	     
	    var token = '{{Session::token()}}';

	    var url = '{{ route("page.update", ":id") }}';
		url = url.replace(':id', id);

	    content_title = $('#edit-title').val();
	    content_text = $('#edit-text').val();

	    $.ajax({
	        method: 'PUT',
	        url: url,
	        data: {content_title: content_title, content_text: content_text, _token: token}

	    })
	    .done(function(){

	         clickEvent.target.parentNode.parentNode.childNodes[1].innerText = content_title;
	         clickEvent.target.parentNode.parentNode.childNodes[3].innerText = content_text;
	        content_title = null; 
			content_text = null;
			id = null;
			clickEvent = null;
	         $('#editModal').modal('hide');

	    });
	});

$('.delete').click(function(event) {
	
	content_title = event.target.parentNode.parentNode.childNodes[1].innerText;
	id = event.target.parentNode.parentNode.dataset['serviceid'];
	 $("#delete-cat").text(content_title);
	 clickEvent = event;

});


    $('#save-delete').click(function(e){
	     
	    var token = '{{Session::token()}}';
	  
	    var url = '{{ route("page.delete", ":id") }}';
		url = url.replace(':id', id);


	    $.ajax({
	        method: 'DELETE',
	        url: url,
	        data: {id: id,  _token: token}

	    })
	    .done(function(){

	         clickEvent.target.parentNode.parentNode.remove();
	         content_title = null; 
			id = null;
			clickEvent = null;
	         $('#deleteModal').modal('hide');

	    });
	});


</script>

@endsection