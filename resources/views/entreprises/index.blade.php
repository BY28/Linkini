@extends('layouts.master')

@section('title')
Entreprises
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
                    <h1 class="tagline">Find your companies with Linkini</h1>
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
        <h1>Entreprises</h1>
        <!-- <h2 class="lead"><strong>3</strong> results were found for the search for <strong >Lorem</strong></h2> -->
    </hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
    
    @foreach($entreprises as $entreprise)

        <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <a href="#" title="Lorem ipsum" class="thumbnail"><img src="{{ URL::to('uploads/business')}}/{{$entreprise->image}}" alt="Lorem ipsum" /></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 result">
                    <h3><a href="#" title="">{{ $entreprise->name }}</a></h3>
                    <p>{{ $entreprise->description }}</p>                        

                    <div class="action">

                                    <a href="{{route('entreprise.edit', [$entreprise->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                   
                                    <button type="button" class="btn btn-success btn-xs" title="Approved">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['entreprise.destroy', $entreprise->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3"><i class="glyphicon glyphicon-tags"></i> Tags
                    <ul class="meta-search">
                        @foreach($entreprise->tags as $tag)
                            {!! link_to('entreprise/tag/' . $tag->tag_url, $tag->tag, ['class' => 'btn btn-xs btn-info']) !!}
                        @endforeach
                    </ul>
                </div>
                <span class="clearfix borda"></span>
        </article>        
        
    @endforeach
        
    </section>


<!--
@foreach($entreprises->chunk(3) as $entrepriseChunk)

  <div class="row-eq-height">

    @foreach($entrepriseChunk as $entreprise)
      
      <div class="col-md-3">
        <div class="thumbnail">
          <img src="{{ URL::to('uploads/business')}}/{{$entreprise->image}}" class="img-responsive" alt="...">
          <div class="caption">
            <h3>{{ $entreprise->name }}</h3>
            <p class="description">{{ $entreprise->description }}</p>
            <div class="clearfix">
              <div class="pull-left link">13 Link(s)</div>
              <a href="#" class="btn btn-success pull-right" role="button"><i class="fa fa-handshake-o" aria-hidden="true"></i> Link</a>
            </div>
          </div>
        </div>
      </div>
    
    @endforeach 
  -->
    @if(Auth::check() and Auth::user()->admin)

      {!! link_to_route('entreprise.create', 'Ajouter une entreprise', [], ['class' => 'btn btn-info pull-right']) !!}
    
    @endif

    {!! $links !!}
  </div>

@endforeach

@endsection