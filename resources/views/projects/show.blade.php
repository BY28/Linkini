@extends('layouts.master')

@section('styles')
<link rel="stylesheet" href="{{ URL::to('src/css/lightbox.css') }}">
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

  .thumbnail img{
    max-width: 100%; /* do not stretch the bootstrap column */
}

.img-wrapper{
  width: 100%;
  padding-bottom: 100%; /* your aspect ratio here! */
  position: relative;
}

.img-wrapper img{
  position: absolute;
  top: 0; 
  bottom: 0; 
  left: 0; 
  right: 0;
  min-height: 100%; 
  max-height: 100%;
  }

  #project_description
  {
    font-size: 1.3em;
  }

  #img-project {
    height: auto; 
    width: auto; 
    max-width: 300px; 
    max-height: 300px;
}
</style>
@endsection

@section('content')
<div id="project-container" style="min-height: 600px; padding: 2em;margin-bottom: 2em;">
<div id="unclose">
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color: #ea5817"><span id="project_title" data-projecttitle="{!! $project->title !!}">{{$project->title}}</span>
                    <small>{{$project->getReadableDateFormat($project->created_at)}}</small>
                    
                      
                      <a href="{{route('messages.sendwithreceiver', $project->user->id)}}" class="btn btn-primary btn-xs" title="Message"><span class="glyphicon glyphicon-envelope"></span></a>
            

                    @if(Auth::check())
                    @if(Auth::user()->entreprise AND $project->launched)
                          @if($links->where('entreprise_id', Auth::user()->entreprise->id)->where('accepted', true)->where('refused', false)->where('confirmed', false)->first())
                          <a href="#" data-toggle="modal" 
   data-target="#confirmModal" class="btn btn-primary btn-xs confirm" data-linkid="{!! $links->where('entreprise_id', Auth::user()->entreprise->id)->where('accepted', true)->where('refused', false)->where('confirmed', false)->first()->id !!}">Confirmer</a></td>
                        @endif
                        
                        @endif
                        @if(Auth::user()->entreprise AND !$project->launched)
                          <a href="#" data-toggle="modal" 
   data-target="{{Auth::user()->entreprise->links()->where('project_id', $project->id)->where('refused', false)->first() ? Auth::user()->entreprise->links()->where('project_id', $project->id)->first()->accepted == 1 ? '#deleteModal' : '#deleteModal' : '#sendModal'}}" class="btn btn-primary btn-xs links" title="Link" data-projectid="{!! $project->id !!}">
                                        
                                             {!! Auth::user()->entreprise->links()->where('project_id', $project->id)->where('refused', false)->first() ? Auth::user()->entreprise->links()->where('project_id', $project->id)->first()->accepted == 1 ? 'Accepted' : 'Linked' : 'Link' !!}
                                    
                                    </a>
                        @endif
                        @if(@Auth::user()->id == $project->user->id)
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
  <div class="col-lg-12">
   <h3 class="title">Images</h3>
      @if(Auth::check())
       @if(Auth::user()->id == $project->user->id)
        {!! Form::open(['route' => ['projects.storeImage', $project->id], 'class' => 'form', 'files' => true, 'method' => 'post']) !!}

        <div class="form-group">
            {!! Form::label('Ajouter une image') !!}
            {!! Form::file('images[]', array('multiple' => true)) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add!', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!} 
        @endif
   @endif
   </div>

      @foreach($project->images as $image)
        <div class="col-md-2" data-imageid="{!! $image->id !!}">
                <div class="thumbnail">
                      <div class="img-wrapper">
                        <a href="{{ URL::to('uploads/project_images')}}/{{$image->image}}" data-title="{{$project->title}}" data-lightbox="{{$project->title}}"><img src="{{ URL::to('uploads/project_images')}}/{{$image->image}}" class="img-responsive img-project"></a> 
                      </div>
                </div> 
                 @if(Auth::check())
                    @if(Auth::user()->id == $project->user->id)
                      {!! Form::open(['method' => 'DELETE', 'route' => ['projects.deleteImage', $image->id]]) !!}
                                          {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cette image ?\')', 'type'=>'submit']) !!}
                                          {!! Form::close() !!}
                    @endif  
                  @endif
        </div>
      @endforeach

</div>


 <div class="row">
            <div class="col-lg-12">
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
                  <div class="col-lg-12">
                      <h1 style="color: #ea5817">Demandes d'attribution
                      @if($links->count() <= 0)
                        <small>En attente d'une demande...</small>
                      @endif  
                      </h1>
                  </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
                         
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
   data-target="#acceptModal" class="links-accept">Accepter</a></td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
          </div>
        @else
        @if($launchedLink)
        <div class="row">
                  <div class="col-lg-12">
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

@if(Auth::user()->entreprise)
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

   <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Confirm Project</h4>
      </div>
      <p> Etes-vous sur de vouloir confirmer le projet<strong id="confirm-cat"></strong> ?</p>
      <div class="modal-footer">
      <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Annuler</button>
        <span class="pull-right">
          <button type="button" class="btn btn-default" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Confirmation du projet" id="save-confirm">
            Confirmer
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
@endif

@endif
@endsection

@section('scripts')
<script src="{{ URL::to('src/js/lightbox.js') }}"></script>
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
var $clickEvent = null;
$('.links-accept').click(function(event) {
   linkId = event.target.parentNode.parentNode.dataset['linkid'];
   $clickEvent = event.target;
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
        $clickEvent.parentNode.parentNode.remove();
        $('#acceptModal').modal('hide');
        $this.button('reset');
        linkId = null;
        $clickEvent = null;
        location.reload();
      });
  });

$('.cancel-link').click(function(event) {
  linkId = event.target.dataset['linkid'];
  $clickEvent = event.target;
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
        $clickEvent.parentNode.parentNode.remove();
        $('#cancelModal').modal('hide');
        $this.button('reset');
        linkId = null;
        $clickEvent = null;
        location.reload();
      });
  });

    $('.links').click(function(event) {
  projectId = event.target.dataset['projectid'];
  $clickEvent = event.target;
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
        if($clickEvent.innerText == 'Link')
        {
          $clickEvent.innerText = 'Linked';
        }
        else
        {
          $clickEvent.innerText = 'Link';
        }
        $($clickEvent).removeAttr('data-target');
        $($clickEvent).attr('data-target', '#deleteModal');
        $('#sendModal').modal('hide');
        $this.button('reset');
        projectId = null;
        $clickEvent = null;
      });
  });

/* UNLINKPROJECT */

$('.links').click(function(event) {
  projectId = event.target.dataset['projectid'];
  $clickEvent = event.target;
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
        if($clickEvent.innerText == 'Linked')
        {
          $clickEvent.innerText = 'Link';
        }
        else
        {
          $clickEvent.innerText = 'Linked';
        }
        $($clickEvent).removeAttr('data-target');
        $($clickEvent).attr('data-target', '#sendModal');
        $('#deleteModal').modal('hide');
        $this.button('reset');
        projectId = null;
        $clickEvent = null;
      });
  });


$('.confirm').click(function(event) {
   linkId = event.target.dataset['linkid'];
   $clickEvent = event.target;
});
    $('#save-confirm').click(function(e){
    var $this = $(this);
    $this.button('loading');

     var token = '{{Session::token()}}';
     var urlCancel = '{{route('links.attributionConfirm')}}';


      $.ajax({
          method: 'POST',
          url: urlCancel,
          data: {linkId: linkId, _token: token}

      })
      .done(function(){
        $clickEvent.parentNode.parentNode.remove();
        $('#confirmModal').modal('hide');
        $this.button('reset');
        event.target.remove();
        linkId = null;
        $clickEvent = null;
      });
  });
</script>

@endsection