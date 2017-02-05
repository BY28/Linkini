@extends('layouts.master')

@section('content')
	<div class="col-sm-offset-4 col-sm-4">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Création d'une demande</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'demand.store', 'files'=>true,'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
						{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
						{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('tag') ? 'has-error' : '' !!}">
						{!! Form::text('tag', null, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
						{!! $errors->first('tag', '<small class="help-block">:message</small>') !!}
					</div>
					<!-- PAS D'IMAGE POUR LE MOMENT
					<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
					Image :
						{!! Form::file('image', ['class' => 'form-control']) !!}
						{!! $errors->first('image', '<small class="help-block">:message</small>') !!}
					</div>
					-->
					<div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
						{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
						{!! $errors->first('content', '<small class="help-block">:message</small>') !!}
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