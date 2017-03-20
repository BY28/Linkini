@extends('layouts.panel.index')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('entreprises.info')}}">
	    <button type="button" class="btn btn-default">Informations</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	    <button type="button" class="btn btn-default">Page</button>
	  </div>
	  <div class="btn-group header-btn" role="group">
	    <button type="button" class="btn btn-default">Notifications</button>
	  </div>
	</div>
</div>
@endsection