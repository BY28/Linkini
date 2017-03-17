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

.search-results{
  position: absolute;
  top: 100%;
  z-index: 20;
}
.search-container
{
  position: relative;
}
/* SEARCH RESULT LIST*/
.list-group-item-linkable:hover {
    color: #555;
    text-decoration: none;
    background-color: #f5f5f5;
    cursor: pointer;
}
.search-results{
    max-height: 325px;
    overflow-y:scroll; 
}
</style>

@endsection

@section('banner')
<!--
<header class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline">Find your companies with Linkini</h1>
            </div>
        </div>
</header>
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

                <li  data-toggle="collapse" data-target="#{{$category->id}}" class="collapsed">
                  <a href="#"><i class="fa fa-gift fa-lg"></i> {{$category->name}} <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="{{$category->id}}">
                  @foreach($category->activities as $activity)
                     <a href="{{route('entreprises.activityResults', $activity->activity_url)}}"><li>{{$activity->name}}</li></a>
                  @endforeach
                </ul>

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
                              <option id="#project_filter">Projets</option>
                              <option id="#activity_filter">Activités</option>
                        </select>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" id="search" name="x" placeholder="Search term...">
                   <ul class="list-group search-results">
              <!-- <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li> -->
            </ul>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
    </div>
    </div>
   </div>

 <hgroup>
        <h1>Entreprises</h1>
        @if(isset($info))
        <h2 class="lead">{{$info}}</h2>                               
        @endif
        <!-- <h2 class="lead"><strong>3</strong> results were found for the search for <strong >Lorem</strong></h2> -->
    </hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
    
    @foreach($entreprises as $entreprise)

        <article class="search-result row" data-entrepriseid="{{$entreprise->id}}">
                <div class="col-xs-12 col-sm-12 col-md-3">
                  <a href="#" title="Lorem ipsum" class="thumbnail"><img src="{{ URL::to('uploads/business')}}/{{$entreprise->image}}" alt="Lorem ipsum" /></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 result">
                    <h3><a href="#" title="">{{ $entreprise->name }}</a></h3>
                    <p>{{ $entreprise->description }}</p>                        

                    <div class="action">

                                      @if(Auth::check())
                                       <a href="{{route('entreprises.edit', [$entreprise->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>

                                         <a href="#" class="btn btn-primary btn-xs favorites" title="Approved">
                                             {!! Auth::user()->favorites()->where('entreprise_id', $entreprise->id)->first() ? 'UnFav' : 'Fav' !!}
                                         </a>

                                          <a href="{{route('messages.sendwithreceiver', $entreprise->user->id)}}" class="btn btn-primary btn-xs" title="Message"><span class="glyphicon glyphicon-envelope"></span></a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['entreprises.destroy', $entreprise->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}

                                      @endif

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3"><i class="glyphicon glyphicon-tags"></i>
                 {!! link_to('entreprises/category/' . $entreprise->activity->category->category_url, $entreprise->activity->category->name) !!}
                    <ul class="meta-search">
                     {!! link_to('entreprises/activity/' . $entreprise->activity->activity_url, $entreprise->activity->name) !!}
                    <!--
                        @foreach($entreprise->tags as $tag)
                            {!! link_to('entreprises/tag/' . $tag->tag_url, $tag->tag, ['class' => 'btn btn-xs btn-info']) !!}
                        @endforeach
                    -->
                    </ul>
                </div>
                <span class="clearfix borda"></span>
        </article>        
        
    @endforeach
        
    </section>

    {!! $links !!}
  </div>


@endsection

@section('scripts')

<script>

$('.favorites').click(function(event)
{
    event.preventDefault();
    
    var token = '{{Session::token()}}';
    var urlFav = '{{route('favorites.add')}}';

    var entrepriseId = event.target.parentNode.parentNode.parentNode.dataset['entrepriseid'];

    $.ajax({
        method: 'POST',
        url: urlFav,
        data: {entrepriseId: entrepriseId, _token: token}

    })
    .done(function(){

         if(event.target.innerText == 'Fav')
         {
            event.target.innerText = 'UnFav';
         }
         else
         {
            event.target.innerText = 'Fav';
         }
         
    });
});

/* SEARCH */

$('#search').on('keyup', function(){
    var timer;
    $value = $(this).val();
    clearTimeout(timer);  
    timer = setTimeout(function() {
    $.ajax({
      type : 'GET',
      url : '{{URL::to('search')}}',
      data : {'search': $value},
      success:function(data){
        var value=$.trim($("#search").val());
        if(value.length>0)
        {
          if(data.no != "")
          {
            $('.search-results').html(data);
          }
        }
        else
        {
          $('.search-results').empty();
        }
      }
    });
  }, 500);
})

</script>

@endsection