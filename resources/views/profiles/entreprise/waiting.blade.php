@extends('layouts.panel.index')

@section('content')
                
 @if(session()->has('info'))
      <div class="alert alert-success alert-dismissible">{!! session('info') !!}</div>
 @else
 <a href="javascript:history.back()" class="btn btn-primary">
	<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
</a>
 @endif

@endsection