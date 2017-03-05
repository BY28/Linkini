@extends('layouts.panel.index')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($notifications as $notification)
               
                    <tr class="clickable-row @if(!$notification->seen) unread @endif " data-href="{{route('projects.show', $notification->project_id)}}">   
                        <td class="view-message  dont-show">{{$notification->title}}</td>
                        <td class="view-message ">{{$notification->content}}</td>
                        <td class="view-message  text-right">{{$notification->created_at}}</td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>
@endsection