@extends('layouts.admin.index')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn @if (Request::is('admin/entreprises')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.getpending')}}">
	    <button type="button" class="btn btn-default">Pending</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('admin/entreprises/accepted')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.getaccepted')}}">
	    <button type="button" class="btn btn-default">Accepted</button>
	    </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('admin/entreprises/checked')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('entreprises.getchecked')}}">
	    <button type="button" class="btn btn-default">Checked</button>
	   </a>
	  </div>
	</div>
</div>
@endsection