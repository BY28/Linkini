@extends('layouts.master')

@section('content')
	<div class="col-sm-offset-4 col-sm-4">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Création de tags</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'tags.store', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('tags') ? 'has-error' : '' !!}">
						{!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
						{!! $errors->first('tags', '<small class="help-block">:message</small>') !!}
					</div>
					{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection