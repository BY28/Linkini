@extends('layouts.panel.index')

@section('styles')
<link rel="stylesheet" href="{{ URL::to('src/css/msg.css') }}">
@endsection

@section('headerButtons')

<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	<div class="btn-group header-btn" role="group">
	  <a href="{{route('projects.all')}}">
	    <button type="button" class="btn btn-default">Tous</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('projects.attributions')}}">
	    <button type="button" class="btn btn-default">Attributions</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('projects.launched')}}">
	    <button type="button" class="btn btn-default">Lancés</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('projects.canceled')}}">
	    <button type="button" class="btn btn-default">Annulés</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('projects.create')}}">
	    <button type="button" class="btn btn-default">Créer</button>
	  </a>
	  </div>
	</div>
</div>

@endsection