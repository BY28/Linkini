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
        <div class="col-xs-11 search-container">
        <form action="{{route('postSearch')}}" method="POST" id="post_search">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <select class="selectpicker" id="select" name="filter">
                              <option class="search-option">Titre/Description</option>
                              <option class="search-option">Tags</option>
                        </select>
                </div>    
                <div class="tags-input form-control" data-name="tags" id="tags"></div>
                <input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un project">
                <input type="hidden" name="tags-input" id="hidden-tag">
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
                                   @if(Auth::check())

                                    @if(Auth::user()->id ==  $project->user_id)
                                    <a href="{{route('projects.edit', [$project->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                    @endif
                                        @if(Auth::user()->entreprise)
                                    <!-- <a href="{{route('links.projectlink')}}" class="btn btn-primary btn-xs links" title="Link">
                                    -->
                                    <a href="#" data-toggle="modal" 
   data-target="{{Auth::user()->entreprise->links()->where('project_id', $project->id)->where('refused', false)->first() ? Auth::user()->entreprise->links()->where('project_id', $project->id)->first()->accepted == 1 ? '#deleteModal' : '#deleteModal' : '#sendModal'}}" class="btn btn-primary btn-xs links" title="Link">
                                        
                                             {!! Auth::user()->entreprise->links()->where('project_id', $project->id)->where('refused', false)->first() ? Auth::user()->entreprise->links()->where('project_id', $project->id)->first()->accepted == 1 ? 'Accepted' : 'Linked' : 'Link' !!}
                                    
                                    </a>

                                    <a href="{{route('messages.sendwithreceiver', $project->user->id)}}" class="btn btn-primary btn-xs" title="Message"><span class="glyphicon glyphicon-envelope"></span></a>
                                        @endif
                                           @if(Auth::user()->id ==  $project->user_id)

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}

                                    @endif
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

    <!-- Modals -->

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
          <input type="text" name="amount" class="form-control" id="amount" placeholder="Montant du service">
        </div>
        <div class="form-group">  
          <input type="text" name="time" class="form-control" id="time" placeholder="Temps de réalisation (délais)">
        </div>
        <div class="form-group">  
          <textarea type="text" name="informations" class="form-control" id="informations" placeholder="Informations supplémentaires..." rows="10"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button> -->
        <span class="pull-right">
          <button type="button" class="btn btn-default" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Envoi de la demande" id="save-send">
            Save
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Cancel Demand</h4>
      </div>
      <p> Etes vous sur de vouloir annuler votre demande d'attribution<strong id="delete-cat"></strong> ?</p>
      <div class="modal-footer">
      <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Annuler</button>
        <span class="pull-right">
          <button type="button" class="btn btn-default" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Annulation de la demande" id="save-delete">
            Confirmer
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script>
/*
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
*/
/* SEARCH */

$('.tags-input').hide();


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

      if($('#select').val() == 'Titre/Description')
      {
        $('#search').prop("placeholder", "Rechercher un projet");
        $('.tags-input').hide();
        $('#search').show();

        $('.search-results').on('click', function(){
           var input = $("#search");
            input.focus();
        });
      }
      else
      {
        $('#search').prop("placeholder", "Mot clé pour la recherche d'un projet (plomberie,construction,électricité...)");
        $('#search').hide();
        $('.tags-input').show();

        $('.tags-input').on('click', function(){
            var input = $(".main-input");
            input.focus();
        });

        $('.search-results').on('click', function(){
           var input = $(".main-input");
            input.focus();
        });
      }
  });
});

/* MODALS */

/* LINKPROJECT */
var projectId = null;
var $buttonClicked = null;

$('.links').click(function(event) {
  projectId = event.target.parentNode.parentNode.parentNode.dataset['projectid'];
  $buttonClicked = event.target;
});
    $('#save-send').click(function(e){
    var $this = $(this);
    $this.button('loading');
      var amount = $('#amount').val();
      var time = $('#time').val();
      var informations = $('#informations').val();

     var token = '{{Session::token()}}';
     var urlLink = '{{route('links.projectlink')}}';


      $.ajax({
          method: 'POST',
          url: urlLink,
          data: {projectId: projectId, amount: amount, time: time, informations: informations, _token: token}

      })
      .done(function(){
        if($buttonClicked.innerText == 'Link')
        {
          $buttonClicked.innerText = 'Linked';
        }
        else
        {
          $buttonClicked.innerText = 'Link';
        }
        $($buttonClicked).removeAttr('data-target');
        $($buttonClicked).attr('data-target', '#deleteModal');
        $('#sendModal').modal('hide');
        $this.button('reset');
        projectId = null;
        $buttonClicked = null;
      });
  });

/* UNLINKPROJECT */

$('.links').click(function(event) {
  projectId = event.target.parentNode.parentNode.parentNode.dataset['projectid'];
});
  $('#save-delete').click(function(e){
    var $this = $(this);
    $this.button('loading');
     var token = '{{Session::token()}}';
     var urlUnLink = '{{route('links.projectunlink')}}';


      $.ajax({
          method: 'POST',
          url: urlUnLink,
          data: {projectId: projectId, _token: token}

      })
      .done(function(){
        if($buttonClicked.innerText == 'Linked')
        {
          $buttonClicked.innerText = 'Link';
        }
        else
        {
          $buttonClicked.innerText = 'Linked';
        }
        $($buttonClicked).removeAttr('data-target');
        $($buttonClicked).attr('data-target', '#sendModal');
        $('#deleteModal').modal('hide');
        $this.button('reset');
        projectId = null;
        $buttonClicked = null;
      });
  });

</script>

@endsection