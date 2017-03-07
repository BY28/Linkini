@extends('layouts.master')

@section('content')

	<div class="col-sm-offset-4 col-sm-4">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Commande d'une entreprise</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'entreprises.postorder', 'files'=>true,'class' => 'form-horizontal panel']) !!}
					<div class="form-group">
						<label for="select">Secteur d'activité</label>
						<select class="selectpicker" id="select" data-size="10" name="activity">
							@foreach($categories as $category)
								 <optgroup label="{{$category->name}}">
								@foreach($category->activities as $activity)
									 <option>{{$activity->name}}</option>
								@endforeach
								</optgroup>
							@endforeach
							</select>

					</div>
					<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
						{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
						{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
						{!! $errors->first('description', '<small class="help-block">:message</small>') !!}
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