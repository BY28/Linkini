@extends('layouts.panel.index')

@section('headerButtons')
<div class="row">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('messages.inbox')}}">
	    <button type="button" class="btn btn-default">Inbox</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('messages.sent')}}">
	    <button type="button" class="btn btn-default">Sent</button>
	  </a>
	  </div>
	  <div class="btn-group header-btn" role="group">
	  <a href="{{route('messages.create')}}">
	    <button type="button" class="btn btn-default">New</button>
	  </a>
	  </div>
	</div>
</div>
@endsection