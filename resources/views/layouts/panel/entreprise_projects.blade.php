@extends('layouts.panel.entreprise')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('entreprises.pendingProjects')}}">
	    <button type="button" class="btn btn-default">Projets</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('entreprises.info')}}">
	    <button type="button" class="btn btn-default">Informations</button>
	  </a>
	  </div>
	</div>
</div>
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('entreprises.pendingProjects')}}">
	    <button type="button" class="btn btn-default">En attente</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('entreprises.attributionProjects')}}">
	    <button type="button" class="btn btn-default">Attributions</button>
	    </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  	<a href="{{route('entreprises.launchedProjects')}}">
	    	<button type="button" class="btn btn-default">Lancé</button>
	    </a>
	  </div>
	</div>
</div>
@endsection