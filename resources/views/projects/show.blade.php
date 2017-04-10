@extends('layouts.master')

@section('styles')
<style>
#project-container
{
    background-color: #fff;
}

.title
{
    color: #0c2444;
    font-weight: bold;
}

#tags
{
    list-style: none;
}
</style>
@endsection

@section('content')
<div id="project-container">
<div class="container" style="min-height: 600px;">
    <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header" style="color: #ea5817"><span id="project_title" data-projecttitle="{!! $project->title !!}">{{$project->title}}</span>
                    <small>{{$project->getReadableDateFormat($project->created_at)}}</small>
                      <a href="{{route('messages.sendwithreceiver', $project->user->id)}}" class="btn btn-primary btn-xs" title="Message"><span class="glyphicon glyphicon-envelope"></span></a>


                    @if(Auth::check())
                        @if(@Auth::user()->id == $project->id)
                            <a href="#" class="btn btn-primary btn-xs edit" id="edit-project" data-projectid="{!! $project->id !!}" data-toggle="modal" data-target="#projectEditModal">Editer</a>
                        @endif
                    @endif
                </h1>
            </div>
    </div>
    <div class="row">
    	
    	<div class="col-md-8">
                <p><span class="title">Categorie :</span> <a href="{{route('projects.categoryResults', $project->category->category_url)}}" id="project_category" data-projectcategory="{!! $project->category->name !!}">{{$project->category->name}}</a></p>
                <p><span class="title">Date :</span> {{$project->created_at->format('d/m/Y')}}</p>
                <p><span class="title">Heure: </span>{{$project->created_at->format('H:m')}}</p>
                <h3 class="title">Description</h3>
                <p id="project_description" data-projectcontent="{!! $project->content !!}">
                  <?php

                    $project->content = nl2br($project->content);
                    $project->content = str_replace('  ', ' &nbsp;', $project->content);

                    echo $project->content;

                  ?>
                </p>        
        </div>
        <div class="col-md-4">
        	
        	<h3 class="title">Tags</h3>
                <ul id="tags">
                	@foreach($project->tags as $tag)
                    <li><i class="fa fa-tag"></i> <a href="{{route('projects.tagResults', $tag->tag)}}" class="project-tags">{{$tag->tag}}</a></li>
                    @endforeach
                </ul>

        </div>

    </div>

 <div class="row">
            <div class="col-lg-11">
                <h1 class="page-header" style="color: #ea5817">Posté par

                </h1>
            </div>
    </div>

       <div class="row">
        
        <div class="col-md-8">
                <p><span class="title">Email :</span> {{$project->user->email}}</p>      
        </div>
    </div>

    @if(Auth::check())

      @if(Auth::user()->id == $project->user->id)

        <?php $launchedLink = $project->getLaunchedLink(); ?>
        @if(!$project->launched AND !$launchedLink)
           <div class="row">
                  <div class="col-lg-11">
                      <h1 style="color: #ea5817">Demandes d'attribution
                      @if($links->count() <= 0)
                        <small>En attente d'une demande...</small>
                      @endif  
                      </h1>
                  </div>
          </div>

          <div class="row">
            <div class="col-lg-11">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                 @foreach($links as $link)
               
                    <tr data-projectid="{{$link->project->id}}" data-linkid="{{$link->id}}">   
                        <td class="view-message  dont-show"><a href="{{route('page.entreprise', $link->entreprise->entreprise_url)}}">{{$link->entreprise->name}}</a></td>
                        <td class="view-message ">{{$link->amount}}</td>
                        <td class="view-message ">{{$link->time}}</td>
                        <td class="view-message ">
                          <?php

                            $link->informations = nl2br($link->informations);
                            $link->informations = str_replace('  ', ' &nbsp;', $link->informations);

                            echo $link->informations;

                          ?>
                        </td>
                        <td class="view-message  text-right">{{$link->created_at}}</td>
                       <td><a href="#" data-toggle="modal" 
   data-target="#acceptModal" class="links">Accepter</a></td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
          </div>
        @else
        @if($launchedLink)
        <div class="row">
                  <div class="col-lg-11">
                      <h1 style="color: #ea5817">Projet Lancé
                      @if($launchedLink->confirmed)
                      <small>Confirmé</small>
                      @else
                         <a href="#" data-toggle="modal" data-target="#cancelModal" class="cancel-link btn btn-xs btn-primary" data-linkid="{{$launchedLink->id}}">Annuler</a>
                      @endif
                      </h1>
                  </div>
          </div>
          <div class="row">
      <div class="col-md-8">
                <p><span class="title">Attribué à : </span> <a href="{{route('page.entreprise', $launchedLink->entreprise->entreprise_url)}}">{{$launchedLink->entreprise->name}}</a></p>
                <p><span class="title">Temps : </span>{{ $launchedLink->time}}</p>
                <p><span class="title">Montant : </span>{{$launchedLink->amount}}</p>
                <h3 class="title">Informations</h3>
                <p >
                  <?php

                    $launchedLink->informations = nl2br($launchedLink->informations);
                    $launchedLink->informations = str_replace('  ', ' &nbsp;', $launchedLink->informations);

                    echo $launchedLink->informations;

                  ?>
                </p>        
        </div>
        @endif

    </div>
        @endif


      @endif

    @endif
</div>

    <a href="javascript:history.back()" class="btn btn-primary" style="margin: 1em;">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
</div>

@if(Auth::check())

    <!-- Modals -->

<div class="modal fade" id="projectEditModal" tabindex="-1" role="dialog" aria-labelledby="projectEditModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Editer le projet</h4>
      </div>
      <form action="{{route('projects.update', $project->id)}}" method="POST" id="project_update_form">
      <div class="modal-body">

      <div class="form-group">
        <input type="text" name="title" class="form-control" id="edit-title">
      </div>
      <div class="form-group">
                        <label for="select">Secteur d'activité</label>
                        <select id="edit-category" class="selectpicker form-control" id="select" data-size="10" name="category">
                            @foreach($categories as $category)
                                     <option>{{$category->name}}</option>
                            @endforeach
                            </select>

                    </div>
                    <div class="form-group {!! $errors->has('tags') ? 'has-error' : '' !!}">
                     <div class="tags-input form-control" data-name="tags" id="tags"></div>
                        
                        {!! $errors->first('tags', '<small class="help-block">:message</small>') !!}
                    </div>
      <div class="form-group">
        <textarea type="text" name="content" class="form-control" id="edit-text" rows="10"></textarea>
      </div>
      {{ csrf_field() }}
      </div>
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="submit" class="btn btn-primary send" id="save-edit">
            Enregistrer
          </button>
        </span>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- AcceptModal -->
   <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Accept Demand</h4>
      </div>
      <p> Accepter la demande d'attribution<strong id="accept-cat"></strong> ?</p>
      <div class="modal-footer">
      <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Annuler</button>
        <span class="pull-right">
          <button type="button" class="btn btn-default" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Accepter de la demande" id="save-accept">
            Confirmer
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
<!-- CANCEL MODAL -->
   <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Cancel Project</h4>
      </div>
      <p> Etes-vous sur de vouloir annuler le projet en cours<strong id="cancel-cat"></strong> ?</p>
      <div class="modal-footer">
      <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Annuler</button>
        <span class="pull-right">
          <button type="button" class="btn btn-default" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Annulation du projet" id="save-cancel">
            Confirmer
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

var title = null; 
var description = null;
var category = null;
var id = null;
var clickEvent = null;

$('.edit').click(function(event) {
  
    title = $('#project_title').data('projecttitle');
    description = $('#project_description').data('projectcontent');
    category = $('#project_category').data('projectcategory');
    
    var liTags = $('.project-tags').map(function() {
    return $(this).html();
    }).get();

    id = event.target.dataset['projectid'];
    $("#edit-title").val(title);
    $("#edit-text").val(description);
    $("#edit-category").val(category);

    /*var e = jQuery.Event("keypress");
    e.which = 13;
    e.keyCode = 13;*/

    var input = '';
   for(i=0; i<liTags.length; i++)
    {
        /*$('.main-input').val(liTags[i]);
        $(".main-input").trigger(e);*/
        input += liTags[i] + ' ';
    }
    liTags = [];
    $('.main-input').val(input);
    $('.main-input').focus();

    clickEvent = event;
});

$('.tags-input').on('click', function(){
            var input = $(".main-input");
            input.focus();            
        });


/* ACCEPT ATTRIBUTION */
var linkId = null;
var $buttonClicked = null;
$('.links').click(function(event) {
   linkId = event.target.parentNode.parentNode.dataset['linkid'];
   $buttonClicked = event.target;
});
    $('#save-accept').click(function(e){
    var $this = $(this);
    $this.button('loading');

     var token = '{{Session::token()}}';
     var urlAccept = '{{route('links.attributionAccept')}}';


      $.ajax({
          method: 'POST',
          url: urlAccept,
          data: {linkId: linkId, _token: token}

      })
      .done(function(){
        $buttonClicked.parentNode.parentNode.remove();
        $('#acceptModal').modal('hide');
        $this.button('reset');
        linkId = null;
        $buttonClicked = null;
        location.reload();
      });
  });

$('.cancel-link').click(function(event) {
  linkId = event.target.dataset['linkid'];
  $buttonClicked = event.target;
});
    $('#save-cancel').click(function(e){
    var $this = $(this);
    $this.button('loading');

     var token = '{{Session::token()}}';
     var urlCancel = '{{route('links.attributionCancel')}}';


      $.ajax({
          method: 'POST',
          url: urlCancel,
          data: {linkId: linkId, _token: token}

      })
      .done(function(){
        $buttonClicked.parentNode.parentNode.remove();
        $('#cancelModal').modal('hide');
        $this.button('reset');
        linkId = null;
        $buttonClicked = null;
        location.reload();
      });
  });
</script>

@endsection