@extends('layouts.master')

@section('title')
Projects
@endsection

@section('styles')

<style type="text/css">
.navbar{
  margin-bottom: 0em;
}

button.btn.btn-default.dropdown-toggle, button.btn.btn-default{
    background-color: #ea5817;
    color: #fff;
}

.btn-default.active.focus, .btn-default.active:focus, .btn-default.active:hover, .btn-default:active.focus, .btn-default:active:focus, .btn-default:active:hover, .open>.dropdown-toggle.btn-default.focus, .open>.dropdown-toggle.btn-default:focus, .open>.dropdown-toggle.btn-default:hover
.content_top span{
    color: #fff;
    background-color: #ea5817;
}

</style>

@endsection

@section('banner')

<header class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline">Find your projects with Linkini</h1>
            </div>
        </div>
</header>

  <div class="content_top">
      <div class="container">
         <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than ></a></li>
                      <li><a href="#less_than">Less than < </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
    </div>
    </div>
   </div>
   
@endsection

@section('content')

 <hgroup>
        <h1>Projects</h1>
        @if(isset($info))
        <h2 class="lead">{{$info}}</h2>                               
        @endif
    </hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
    
    @foreach($projects as $project)

        <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <ul class="meta-search pull-left">
                        <li><i class="glyphicon glyphicon-calendar"></i> <span>{!! $project->created_at->format('d/m/Y') !!}</span></li>
                        <li><i class="glyphicon glyphicon-time"></i> <span>{!! $project->created_at->format('H:m') !!}</span></li>
                        <li><i class="glyphicon glyphicon-user"></i> <span>{!! $project->user->email !!}</span></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 result">
                    <h3><a href="#" title="">{{ $project->title }}</a></h3>
                    <p>{{ $project->content }}</p>                        

                    <div class="action">

                                    <a href="{{route('projects.edit', [$project->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                   
                                    <button type="button" class="btn btn-success btn-xs" title="Approved">
                                        
                                        @if(Auth::check())
                                            @if(Auth::user()->entreprise)
                                                 {!! Auth::user()->entreprise->links()->where('project_id', $project->id)->first() ? Auth::user()->entreprise->links()->where('project_id', $project->id)->first()->accepted == 1 ? 'Accepted' : 'Linked' : 'Link' !!}
                                            @endif
                                        @endif

                                    </button>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3"><i class="glyphicon glyphicon-tags"></i> Tags
                    <ul class="meta-search">
                        @foreach($project->tags as $tag)
                            {!! link_to('projects/tag/' . $tag->tag_url, $tag->tag, ['class' => 'btn btn-xs btn-info']) !!}
                        @endforeach
                    </ul>
                </div>
                <span class="clearfix borda"></span>
        </article>        
        
    @endforeach
        
    </section>
    @if(Auth::check() and Auth::user()->admin)

      {!! link_to_route('projects.create', 'Ajouter un project', [], ['class' => 'btn btn-info pull-right']) !!}
    
    @endif

    {!! $links !!}
@endsection

@section('scripts')

<script>

$('.links').click(function(event)
{
    event.preventDefault();
    
    var token = '{{Session::token()}}';
    var urlLink = '{{route('links.projectlink')}}';

    var projectId = event.target.parentNode.parentNode.parentNode.dataset['projectid'];

    $.ajax({
        method: 'POST',
        url: urlLink,
        data: {projectId: projectId, _token: token}

    })
    .done(function(){

         if(event.target.innerText == 'Link')
         {
            event.target.innerText = 'Linked';
         }
         else
         {
            event.target.innerText = 'Link';
         }
         
    });
});

</script>

@endsection
