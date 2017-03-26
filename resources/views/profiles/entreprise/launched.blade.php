@extends('layouts.panel.entreprise_projects')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($links as $link)
               
                    <tr data-projectid="{{$link->project->id}}" data-linkid="{{$link->id}}">   
                        <td class="view-message  dont-show"><a href="{{route('projects.show', $link->project->id)}}">{{$link->project->title}}</a></td>
                        <td class="view-message ">{{$link->project->content}}</td>
                        <td class="view-message  text-right">{{$link->created_at}}</td>
                        @if(!$link->confirmed)
                         <td><a href="#" data-toggle="modal" 
   data-target="#confirmModal" class="links">Confirmer</a></td>
                        @else
                        <td>Confirmé</td>
                        @endif
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

   <!-- MODALS -->

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
@endsection

@section('scripts')

<script>
/*
$('.launch').click(function(event)
{
    event.preventDefault();
    
    var token = '{{ Session::token() }}';
    var urlLaunch = '{{ route('projects.launch') }}';

    var projectId = event.target.parentNode.parentNode.dataset['projectid'];

    $.ajax({
        method: 'POST',
        url: urlLaunch,
        data: {projectId: projectId, _token: token}

    })
    .done(function(){
        event.target.parentNode.parentNode.remove();
    });
});
*/

/* MODALS */
var linkId = null;
var $buttonClicked = null;
$('.links').click(function(event) {
   linkId = event.target.parentNode.parentNode.dataset['linkid'];
   $buttonClicked = event.target;
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
        $buttonClicked.parentNode.parentNode.remove();
        $('#confirmModal').modal('hide');
        $this.button('reset');
        linkId = null;
        $buttonClicked = null;
      });
  });
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

@endsection