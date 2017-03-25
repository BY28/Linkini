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
                       <td><a href="#" data-toggle="modal" 
   data-target="#acceptModal" class="links">Accepter</a></td>
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

   <!-- MODALS -->

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
    $('#save-accept').click(function(e){
    event.preventDefault();
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
        event.target.parentNode.parentNode.remove();
        $('#acceptModal').modal('hide');
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