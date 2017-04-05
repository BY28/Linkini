@extends('layouts.panel.settings')

@section('content')
<div class="col-sm-12">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Modification d'un utilisateur</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::model($user->entreprise, ['route' => ['entreprises.update', $user->entreprise->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}			
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
					  	{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
					  	{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
					  	{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Tel.']) !!}
					  	{!! $errors->first('phone', '<small class="help-block">:message</small>') !!}
					</div>
					</div>
					<div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!}">
					  	{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
					  	{!! $errors->first('address', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'rows' => '15']) !!}
					  	{!! $errors->first('description', '<small class="help-block">:message</small>') !!}
					</div>

						{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
		</div>
@endsection