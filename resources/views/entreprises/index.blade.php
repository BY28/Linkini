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

#entreprises-section
{
  background: #fff;
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
        <div class="col-xs-11 search-container">
        <form action="{{route('postSearch')}}" method="POST" id="post_search">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <select class="selectpicker" id="select" name="filter">
                              <option class="search-option">Nom/Description</option>
                              <option class="search-option">Secteur d'activité</option>
                        </select>
                </div>    
                <input type="text" class="form-control" id="entreprise" name="name" placeholder="Rechercher quelqu'un pour concrétiser vos projets" autocomplete="off">
                <input type="text" class="form-control" id="search" name="search" placeholder="Rechercher dans un secteur d'activité" autocomplete="off">
                   <ul class="list-group search-results">
             <!--  <li class="list-group-item list-group-item-linkable">Cras justo odio</li>
             <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li> -->
            </ul>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
            {{csrf_field()}}
        </form>
        </div>
    </div>
    </div>
   </div>

    <section class="col-xs-12 col-sm-12 col-md-12" id="entreprises-section">

     <hgroup>
        <h1>Entreprises</h1>
        @if(isset($info))
        <h2 class="lead">{{$info}}</h2>                               
        @endif
        <!-- <h2 class="lead"><strong>3</strong> results were found for the search for <strong >Lorem</strong></h2> -->
    </hgroup>
    
    @foreach($entreprises as $entreprise)

        <article class="search-result row" data-entrepriseid="{{$entreprise->id}}">
                <div class="col-xs-3 col-sm-3 col-md-3 hidden-xs">
                  <a href="#" title="Lorem ipsum" class="thumbnail"><img src="{{ URL::to('uploads/business')}}/{{$entreprise->image}}" alt="Lorem ipsum" /></a>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 result">
                    <h3><a href="{{route('page.entreprise', $entreprise->entreprise_url)}}" title="">{{ $entreprise->name }}</a></h3>
                    <p>{{ $entreprise->description }}</p>                        

                    <div class="action">

                                      @if(Auth::check())
                                       <!-- <a href="{{route('entreprises.edit', [$entreprise->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a> -->

                                         <button type="button" class="btn btn-primary btn-xs favorites" data-loading-text="<i class='fa fa-refresh fa-spin'></i>" title="Approved">
                                             {!! Auth::user()->favorites()->where('entreprise_id', $entreprise->id)->first() ? 'UnFav' : 'Fav' !!}
                                         </button>
                                         @if(Auth::user()->projects->count() > 0)
                                          <a href="#" data-toggle="modal" 
   data-target="#sendModal" class="btn btn-primary btn-xs links" title="Link">Notification</a>
                                          @endif
                                          <a href="{{route('messages.sendwithreceiver', $entreprise->user->id)}}" class="btn btn-primary btn-xs" title="Message"><span class="glyphicon glyphicon-envelope"></span></a>

                                       <!--  {!! Form::open(['method' => 'DELETE', 'route' => ['entreprises.destroy', $entreprise->id]]) !!}
                                        {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                        {!! Form::close() !!} -->

                                      @endif

                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3"><i class="glyphicon glyphicon-tags"></i>
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
        
        {!! $links !!}
    </section>

  </div>

    <!-- Modals -->
@if(Auth::check())
<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Send Demand</h4>
      </div>
      <div class="modal-body form-group">
        <div class="form-group">
          <select id="project-select" name="projectselect" class="form-control selectpicker">
            @foreach(Auth::user()->projects as $project)
                <option value="{{$project->id}}">{{$project->title}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button> -->
        <span class="pull-right">
          <button type="button" class="btn btn-default" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Envoi de la notification" id="save-send">
            Save
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
@endif
@endsection

@section('scripts')

<script>

$('.favorites').click(function(event)
{
    event.preventDefault();
    var $this = $(this);
    //$this.button('loading');
    var text = event.target.innerText;
    $this.attr('disabled', 'disabled');
    $this.html('<i class="fa fa-refresh fa-spin"></i>');
    var token = '{{Session::token()}}';
    var urlFav = '{{route('favorites.add')}}';

    var entrepriseId = event.target.parentNode.parentNode.parentNode.dataset['entrepriseid'];

    $.ajax({
        method: 'POST',
        url: urlFav,
        data: {entrepriseId: entrepriseId, _token: token}

    })
    .done(function(){
         //$this.button('reset');
        $this.removeAttr('disabled');
         if(text == 'Fav')
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

$('#search').hide();


  $('#search').on('keyup', function(){
      var timer;
      $value = $(this).val();
      $filter = $('#select').val();

      clearTimeout(timer);  
      timer = setTimeout(function() {
      $.ajax({
        type : 'GET',
        url : '{{URL::to('search')}}',
        data : {'search': $value, 'filter': $filter},
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
    }, 100);
  })

  $('.main-input').on('keyup', function(){
      var timer;
      $value = $(this).val();
      $filter = $('#select').val();

      clearTimeout(timer);  
      timer = setTimeout(function() {
      $.ajax({
        type : 'GET',
        url : '{{URL::to('search')}}',
        data : {'search': $value, 'filter': $filter},
        success:function(data){
           var value=$(".main-input").val().replace('/\s/g','');
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
    }, 100);
  })

/* SEARCH */
$(document).ready(function() {

  $('#select').change(function(){

      if($('#select').val() == "Secteur d'activité")
      {
        $('#search').prop("placeholder", "Rechercher dans un secteur d'activité");
        $('#entreprise').hide();
        $('#search').show();

        $('.search-results').on('click', function(){
           var input = $("#search");
            input.focus();
        });
      }
      else
      {
        $('#search').prop("placeholder", "Recherchez quelqu'un pour concrétiser vos projet");
        $('#search').hide();
        $('#entreprise').show();

      }
  });
});

/* MODALS */
/*SEND NOTIFICATION*/
var entrepriseId = null;
$('.links').click(function(event) {
  entrepriseId = event.target.parentNode.parentNode.parentNode.dataset['entrepriseid'];
});
    $('#save-send').click(function(e){
    var $this = $(this);
    $this.button('loading');

     var token = '{{Session::token()}}';
     var urlLink = '{{route('links.linkorder')}}';
     var projectId = $('#project-select').val();

      $.ajax({
          method: 'POST',
          url: urlLink,
          data: {projectId: projectId, entrepriseId: entrepriseId, _token: token}

      })
      .done(function(){
        $('#sendModal').modal('hide');
        $this.button('reset');
        entrepriseId = null;
      });
  });
</script>

@endsection