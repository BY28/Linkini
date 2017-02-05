@extends('layouts.master')

@section('content')
    <div class="col-sm-offset-4 col-sm-4">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Fiche d'entreprise</div>
			<div class="panel-body">
				<p>Name : {{ $entreprise->name }}</p>
				<p>Description : {{ $entreprise->description }}</p>
			</div>
		</div>				
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection