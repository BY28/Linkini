@extends('layouts.panel.messages')

@section('content')
                
   <div class="row">
   	
	   	<h1>{{$message->subject}}</h1>
	   	<h3>{{$message->sender->email}}</h3>
	   	<p>{{$message->created_at}}</p>
	   	<p>{{$message->message}}</p>
	   	
   </div>

@endsection