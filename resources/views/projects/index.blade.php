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

button.btn.btn-default.dropdown-toggle:active, button.btn.btn-default:active{
    background-color: #ea5817;
    color: #fff;
}

button.btn.btn-default.dropdown-toggle:hover, button.btn.btn-default:hover{
    background-color: #ea5817;
    color: #fff;
}

.info-btn
{
  float: right;
  margin: 0.4em;
  -webkit-animation: bounce 10s infinite;

}

@-webkit-keyframes bounce {
  0%, 20%, 25%, 30%, 35% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }
  23% {
    -webkit-transform: translateX(-15px);
    transform: translateX(-15px);
  }
  27% {
    -webkit-transform: translateX(-5px);
    transform: translateX(-5px);
  }
}

@-moz-keyframes bounce {
  0%, 20%, 25%, 30%, 35% {
    transform: translateX(0);
  }
  23% {
    transform: translateX(-15px);
  }
  27% {
    transform: translateX(-5px);
  }
}

@keyframes bounce {
  0%, 20%, 25%, 30%, 35% {
    -ms-transform: translateX(0);
    transform: translateX(0);
  }
  23% {
    -ms-transform: translateX(-15px);
    transform: translateX(-15px);
  }
  27% {
    -ms-transform: translateX(-5px);
    transform: translateX(-5px);
  }
}

.btn-lg
{
    border-radius: 0px;
    background-color: #ea5817;
    border: none;
}

.btn-lg:hover
{
    border-radius: 0px;
    background-color: #f96625;
    border: none;
}

.btn-lg:active
{
    border-radius: 0px;
    background-color: #ea5817;
    border: none;
}


.search-results{
  position: absolute;
  top: 100%;
   z-index: 1;
}
.search-container
{
  position: relative;
}
</style>

@endsection

@section('banner')
<!--
<header class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline">Find your projects with Linkini</h1>
            </div>
        </div>
</header>
pre-scrollable
-->
@endsection

@section('sidebar')

<div class="nav-side-menu">
    <div class="brand">Secteurs<i class="fa fa-angle-right fa-2x info-btn"></i></div>
    
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="#">
                  <i class="fa fa-dashboard fa-lg"></i> Secteurs d'activités
                  </a>
                </li>
                @foreach($categories as $category)

                <li>
                  <a href="{{route('projects.categoryResults', $category->category_url)}}"><i class="fa fa-gift fa-lg"></i> {{$category->name}} <span class="arrow"></span></a>
                </li>

                @endforeach
            </ul>
     </div>
</div>

@endsection

@section('content')
  <div class="content_top">
      <div class="container">
         <div class="row">    
        <div class="col-xs-8 col-xs-offset-2 search-container">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                   <select class="selectpicker" id="select" name="filter">
                              <option>Projets</option>
                              <option>Activités</option>
                        </select>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Search term...">
                <ul class="list-group search-results"></ul>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
    </div>
    </div>
   </div>
   
 <hgroup>
        <h1>Projects</h1>
         @if(isset($info))
        <h2 class="lead">{{$info}}</h2>                               
        @endif
        <!-- <h2 class="lead"><strong>3</strong> results were found for the search for <strong >Lorem</strong></h2> -->
    </hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
    
    @foreach($projects as $project)

        <article class="search-result row" data-projectid="{{$project->id}}">
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
                                     @if(Auth::user()->id ==  $project->user_id)
                                    <a href="{{route('projects.edit', [$project->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                    @endif
                                   @if(Auth::check())
                                        @if(Auth::user()->entreprise)
                                    <a href="{{route('links.projectlink')}}" class="btn btn-primary btn-xs links" title="Link">
                                    
                                    
                                        
                                             {!! Auth::user()->entreprise->links()->where('project_id', $project->id)->first() ? Auth::user()->entreprise->links()->where('project_id', $project->id)->first()->accepted == 1 ? 'Accepted' : 'Linked' : 'Link' !!}
                                        
                                  
                                    
                                    </a>

                                    <a href="{{route('messages.sendwithreceiver', $project->user->id)}}" class="btn btn-primary btn-xs" title="Message"><span class="glyphicon glyphicon-envelope"></span></a>
                                        @endif
                                      @endif

                                    @if(Auth::user()->id ==  $project->user_id)

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}

                                    @endif
                    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3"><i class="glyphicon glyphicon-tags"></i>  {!! link_to('projects/category/' . $project->category->category_url, $project->category->name) !!}
                
                    <ul class="meta-search">Tags
                        @foreach($project->tags as $tag)
                            {!! link_to('projects/tag/' . $tag->tag_url, $tag->tag, ['class' => 'btn btn-xs btn-info']) !!}
                        @endforeach
                    </ul>
                </div>
                <span class="clearfix borda"></span>
        </article>        
        
    @endforeach
        
    </section>

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