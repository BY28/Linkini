@extends('layouts.panel.projects')

@section('content')
                
   <div class="row">
   	
   <div class="panel">	
			
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'projects.store', 'files'=>true,'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
						{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
						{!! $errors->first('title', '<small class="help-block">:project</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('tags') ? 'has-error' : '' !!}">
						{!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
						{!! $errors->first('tags', '<small class="help-block">:project</small>') !!}
					</div>
					<!-- PAS D'IMAGE POUR LE MOMENT
					<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
					Image :
						{!! Form::file('image', ['class' => 'form-control']) !!}
						{!! $errors->first('image', '<small class="help-block">:project</small>') !!}
					</div>
					-->
					<div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
						{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
						{!! $errors->first('content', '<small class="help-block">:project</small>') !!}
					</div>
					{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

   </div>

@endsection