@extends('layouts.panel.messages')

@section('content')
                
   <div class="row inbox">

	   	<div class="panel panel-default">
      
      <div class="panel-body message"> 
          

        <h2>{{$message->subject}}</h2>
        <div class="header">

          <img class="avatar" src="http://bootdey.com/img/Content/avatar/avatar1.png">


          <div class="from">
            <span>{{$message->sender->email}}</span>
            <a class="" href="#">Name</a>
          </div>
          <div class="date"><span class="fa fa-paper-clip"></span>{{$message->created_at}}</div>

          	<div class="content" id="message">
          		<?php

					$message->message = nl2br($message->message);
					$message->message = str_replace('  ', ' &nbsp;', $message->message);

					echo $message->message;
          		?>
        	</div> 

        </div>

        <form method="post" action="">
          
          <div class="form-group">
          
            <textarea class="form-control" id="message" name="body" rows="12" placeholder="Click here to reply"></textarea>
          
          </div>
          
          <div class="form-group">  

            <button tabindex="3" type="submit" class="btn btn-success">Send message</button>
          
          </div>  

        </form>
        
      </div>
    </div>  
	   	
   </div>

@endsection