@extends('layouts.panel.messages')

@section('content')
                
   <div class="row">
   	
   <div class="panel">	
			
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'messages.send', 'files'=>true,'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
					@if(isset($receiver))
						{!! Form::text('email', $receiver->email, ['class' => 'form-control', 'placeholder' => 'To']) !!}
					@else
						{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'To']) !!}
					@endif
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('subject') ? 'has-error' : '' !!}">
						{!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject']) !!}
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
						{!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message']) !!}
						{!! $errors->first('message', '<small class="help-block">:message</small>') !!}
					</div>
					{{ Form::button('Envoyer', ['type' => 'submit', 'class' => 'btn btn-primary pull-right send', 'data-loading-text' => '<i class="fa fa-refresh fa-spin"></i> Envoi du message']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

   </div>

@endsection

@section('scripts')
<script type="text/javascript">
	
$('.send').click(function(event)
{

    var $this = $(this);
    $this.button('loading');

});
</script>
@endsection