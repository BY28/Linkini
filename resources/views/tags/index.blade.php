@extends('layouts.master')

@section('content')
    <div class="col-sm-offset-4 col-sm-4">
    	@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		@endif
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des tags</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Email</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tags as $tag)
						<tr>
							<td>{!! $tag->id !!}</td>
							<td class="text-primary"><strong>{!! $tag->tag !!}</strong></td>
							<td>{!! link_to_route('tags.show', 'Voir', [$tag->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('tags.edit', 'Modifier', [$tag->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['tags.destroy', $tag->id]]) !!}
									{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce tag ?\')']) !!}
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! link_to_route('tags.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $links !!}
	</div>
@endsection