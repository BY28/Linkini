@extends('layouts.master')

@section('content')

	<div class="col-sm-offset-2 col-sm-8">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Commande d'une entreprise</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'entreprises.postorder', 'files'=>true,'class' => 'form-horizontal panel']) !!}
					<div class="form-group">
						<label for="select">Secteur d'activité</label>
						<select class="selectpicker form-control" id="select" data-size="10" name="activity">
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
						{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Dénomination professionnelle']) !!}
						{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
						{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email professionnel']) !!}
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
						{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Telephone']) !!}
						{!! $errors->first('phone', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('address') ? 'has-error' : '' !!}">
						{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) !!}
						{!! $errors->first('address', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
						{!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description de votre activité']) !!}
						{!! $errors->first('description', '<small class="help-block">:message</small>') !!}
					</div>
					{!! Form::button('Envoyer', ['type' => 'submit', 'class' => 'btn btn-primary pull-right send', 'data-loading-text' => '<i class="fa fa-refresh fa-spin"></i> Envoi de la commande']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
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