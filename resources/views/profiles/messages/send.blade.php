@extends('layouts.panel.messages')

@section('content')
                
   <div class="row">
   	
   <div class="panel panel-primary">	
			<div class="panel-heading">Création d'un Message</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'messages.send', 'files'=>true,'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
						{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('subject') ? 'has-error' : '' !!}">
						{!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
						{!! $errors->first('subject', '<small class="help-block">:message</small>') !!}
					</div>
					<!-- PAS D'IMAGE POUR LE MOMENT
					<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
					Image :
						{!! Form::file('image', ['class' => 'form-control']) !!}
						{!! $errors->first('image', '<small class="help-block">:message</small>') !!}
					</div>
					-->
					<div class="form-group {!! $errors->has('message') ? 'has-error' : '' !!}">
						{!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'message']) !!}
						{!! $errors->first('message', '<small class="help-block">:message</small>') !!}
					</div>
					{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

   </div>

@endsection