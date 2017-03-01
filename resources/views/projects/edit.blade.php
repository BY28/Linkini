@extends('layouts.master')

@section('content')
    <div class="col-sm-offset-4 col-sm-4">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Modification d'un project</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
					  	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
					  	{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
					  	{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'content']) !!}
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