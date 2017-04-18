@extends('layouts.panel.settings')

@section('styles')
<link rel="stylesheet" href="{{ URL::to('src/css/lightbox.css') }}">
@endsection

@section('content')

<div class="col-sm-6">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">INFORMATIONS</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}

					<div class="form-group {!! $errors->has('first_name') ? 'has-error' : '' !!}">
					  	{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
					  	{!! $errors->first('first_name', '<small class="help-block">:message</small>') !!}
					</div>

					<div class="form-group {!! $errors->has('last_name') ? 'has-error' : '' !!}">
					  	{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
					  	{!! $errors->first('last_name', '<small class="help-block">:message</small>') !!}
					</div>

					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
					  	{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
					  	{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>

					<div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
					  	{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Tel']) !!}
					  	{!! $errors->first('phone', '<small class="help-block">:message</small>') !!}
					</div>

					<div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!}">
					  	{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
					  	{!! $errors->first('address', '<small class="help-block">:message</small>') !!}
					</div>

					<div class="form-group {!! $errors->has('informations') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('informations', null, ['class' => 'form-control', 'placeholder' => 'Ajoutez des informations supplémentaires (métier, passions, description...)']) !!}
					  	{!! $errors->first('informations', '<small class="help-block">:message</small>') !!}
					</div>
					<!--
					@if(Auth::user()->admin)
					<div class="form-group">
						<div class="checkbox">
							<label>
								{!! Form::checkbox('admin', 1, null) !!}Administrateur
							</label>
						</div>
					</div>
					@endif
					-->
						{!! Form::submit('Enregistrer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>

	  	<div class="col-sm-6">
	  	    	<br>
   		<div class="panel panel-primary">	
			<div class="panel-heading">IMAGE</div>
				<div class="panel-body"> 

			        {!! Form::open(['route' => ['user.updateImage', $user->id], 'class' => 'form', 'files' => true, 'method' => 'post']) !!}

			        
                        <a href="{{ URL::to('uploads/users')}}/{{$user->image}}" data-title="{{$user->first_name}}" data-lightbox="{{$user->first_name}}"><img src="{{ URL::to('uploads/users')}}/{{$user->image}}" class="img-responsive img-thumbnail"></a> 


			        <div class="form-group">
			            {!! Form::label('Modifier') !!}
			            {!! Form::file('image', null) !!}
			        </div>

			        <div class="form-group">
			            {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
			        </div>

			        {!! Form::close() !!} 
			</div>
		</div>
  	</div>

@endsection

@section('scripts')
<script src="{{ URL::to('src/js/lightbox.js') }}"></script>
@endsection