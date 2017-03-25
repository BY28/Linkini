@extends('layouts.panel.projects')

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
                        @if(!$link->confirmed)
                         <td><a href="#" data-toggle="modal" 
   data-target="#cancelModal" class="links">Annuler</a></td>
                    </tr>
                    @else
                    <td>Confirmé</td>
                        @endif
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>
   <!-- MODALS -->

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
$('.links').click(function(event) {
  
   var linkId = event.target.parentNode.parentNode.dataset['linkid'];
   console.log(linkId);
    $('#save-cancel').click(function(e){
    event.preventDefault();
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
        event.target.parentNode.parentNode.remove();
        $('#cancelModal').modal('hide');
        $this.button('reset');
      });
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