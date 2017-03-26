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
                        <td class="view-message ">{{$link->amount}}</td>
                        <td class="view-message ">{{$link->time}}</td>
                        <td class="view-message ">{{$link->informations}}</td>
                        <td class="view-message  text-right">{{$link->created_at}}</td>
                        <td><a href="#" data-toggle="modal" 
   data-target="#deleteModal" class="links">Annuler</a></td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

   <!-- MODALS -->

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
var projectId = null;
var linkId = null;
var $buttonClicked = null;
$('.links').click(function(event) {  
   projectId = event.target.parentNode.parentNode.dataset['projectid'];
   linkId = event.target.parentNode.parentNode.dataset['linkid'];
   $buttonClicked = event.target;
});

    $('#save-delete').click(function(e){
    var $this = $(this);
    $this.button('loading');

     var token = '{{Session::token()}}';
     var urlUnLink = '{{route('links.projectunlink')}}';


      $.ajax({
          method: 'POST',
          url: urlUnLink,
          data: {linkid: linkId, projectId: projectId, _token: token}

      })
      .done(function(){
        $buttonClicked.parentNode.parentNode.remove();
        $('#deleteModal').modal('hide');
        $this.button('reset');
        projectId = null;
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