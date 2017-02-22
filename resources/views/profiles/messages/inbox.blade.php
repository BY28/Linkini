@extends('layouts.panel.messages')

@section('content')
                
   <div class="row">
   	
   	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>Subject</th>
	      <th>User</th>
	      <th>Time</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($messages as $message)
	  	
	  		<tr>
	     		<td><a href="{{route('messages.message', $message->id)}}">{{$message->subject}}</a></td>
	     		<td>{{$message->sender->email}}</td>
	     		<td>{{$message->created_at}}</td>
	    	</tr>
	    
	  	@endforeach
	  </tbody>
	</table>

   </div>

@endsection