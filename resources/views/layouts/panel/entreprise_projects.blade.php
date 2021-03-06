@extends('layouts.panel.entreprise')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn header-btn-active" role="group">
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
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn @if (Request::is('profile/entreprise/projects')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.pendingProjects')}}">
	    <button type="button" class="btn btn-default">Demandes</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('profile/entreprise/projects/attributions')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.attributionProjects')}}">
	    <button type="button" class="btn btn-default">Attributions</button>
	    </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('profile/entreprise/projects/launched')) {{'header-btn-active'}} @endif" role="group">
	  	<a href="{{route('entreprises.launchedProjects')}}">
	    	<button type="button" class="btn btn-default">Lancés</button>
	    </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('profile/entreprise/projects/canceled')) {{'header-btn-active'}} @endif" role="group">
	  	<a href="{{route('entreprises.canceledProjects')}}">
	    	<button type="button" class="btn btn-default">Annulés</button>
	    </a>
	  </div>
	</div>
</div>
@endsection