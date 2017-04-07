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
            <div class="col-lg-12">
                <h1 class="page-header" style="color: #ea5817"><span id="project_title">{{$project->title}}</span>
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
                <p><span class="title">Categorie :</span> <a href="{{route('projects.categoryResults', $project->category->category_url)}}" id="project_category">{{$project->category->name}}</a></p>
                <p><span class="title">Date :</span> {{$project->created_at->format('d/m/Y')}}</p>
                <p><span class="title">Heure: </span>{{$project->created_at->format('H:m')}}</p>
                <h3 class="title">Description</h3>
                <p id="project_description">{{$project->content}}</p>        
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
                <h1 class="page-header" style="color: #ea5817">Posté par

                </h1>
            </div>
    </div>

       <div class="row">
        
        <div class="col-md-8">
                <p><span class="title">Email :</span> {{$project->user->email}}</p>      
        </div>
    </div>

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
  
    title = $('#project_title').html();
    description = $('#project_description').html();
    category = $('#project_category').html();
    
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



</script>

@endsection