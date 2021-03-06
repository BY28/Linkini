@extends('layouts.panel.index')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn @if (Request::is('profile/entreprise/projects')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.pendingProjects')}}">
	    <button type="button" class="btn btn-default">Projets</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('profile/entreprise/page')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.info')}}">
	    <button type="button" class="btn btn-default">Page</button>
	  </a>
	  </div>
	</div>
</div>
@endsection