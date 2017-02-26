@extends('layouts.panel.messages')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($messages as $message)
               
                    <tr class="clickable-row @if(!$message->read) unread @endif " data-href="{{route('messages.message', $message->id)}}">   
                        <td class="view-message  dont-show">{{$message->sender->email}}</td>
                        <td class="view-message ">{{$message->subject}}</td>
                        <td class="view-message  text-right">{{$message->created_at}}</td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

@endsection