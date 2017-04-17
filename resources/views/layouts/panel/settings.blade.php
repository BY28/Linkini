@extends('layouts.panel.index')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn @if (Request::is('profile') OR Request::is('profile/settings')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('settings.account')}}">
	    <button type="button" class="btn btn-default">Compte</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn @if (Request::is('profile/settings/entreprise')) {{'header-btn-active'}} @endif" role="group">
	  <a href="{{route('settings.entreprise')}}">
	    <button type="button" class="btn btn-default">Entreprise</button>
	    </a>
	  </div>
	  <!--
	  <div class="btn-group header-btn" role="group">
	    <button type="button" class="btn btn-default">Notifications</button>
	  </div>
	  -->
	</div>
</div>
@endsection