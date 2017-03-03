@extends('layouts.panel.index')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($links as $link)
               
                    <tr class="clickable-row @if(!$message->read) unread @endif " data-href="{{route('messages.message', $message->id)}}">   
                        <td class="view-message  dont-show">{{$link->id}}</td>
                        <td class="view-message ">{{$link->id}}</td>
                        <td class="view-message  text-right">{{$link->id}}</td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

@endsection