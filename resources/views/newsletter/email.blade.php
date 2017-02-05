@extends('layouts.master')

@section('title')
	NewsLetter
@endsection

@section('content')
<div class="row">
	<div class="col-sm-offset-4 col-sm-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				Inscription à la NewsLetter
			</div>
			<div class="panel-body"> 
				<form action="{{ route('storeEmail') }}" method="post">
				
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!} ">
					
						<label for="email">Email</label>
						<input type="email" name="email" class="form-control" id="email">
					{!! $errors->first('email', '<small class="help-block">:message</small>') !!}

					</div>
					<button type="submit" class="btn btn-info pull-right">Envoyer</button>
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection