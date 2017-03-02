@extends('layouts.panel.projects')

@section('content')
                
   <div class="row">
   	
   <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($projects as $project)
               
                    <tr class="clickable-row @if(!$project->read) unread @endif " data-href="{{route('projects.project', $project->id)}}">   
                        <td class="view-message  dont-show">{{$project->title}}</td>
                        <td class="view-message ">{{$project->content}}</td>
                        <td class="view-message  text-right">{{$project->created_at}}</td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>

   </div>

@endsection