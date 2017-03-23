@extends('layouts.panel.entreprise_projects')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($links as $link)
               
                    <tr data-projectid="{{$link->project->id}}">   
                        <td class="view-message  dont-show"><a href="{{route('projects.show', $link->project->id)}}">{{$link->project->title}}</a></td>
                        <td class="view-message">{{$link->amount}}</td>
                        <td class="view-message">{{$link->time}}</td>
                        <td class="view-message">{{$link->informations}}</td>
                        <td class="view-message  text-right">{{$link->created_at}}</td>
                       <!--
                            <td><a href="#" class="links" data-toggle="modal" data-target="#sendModal">Réenvoyer</a></td>
                        -->
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

    <!-- Modals 

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
     
        <span class="pull-right">
          <button type="button" class="btn btn-default" id="save-send">
            Save
          </button>
        </span>
      </div>
    </div>
  </div>
</div>-->
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
/* MODALS
$('.links').click(function(event) {
  var projectId = event.target.parentNode.parentNode.dataset['projectid'];
  $('#amount').val(event.target.parentNode.parentNode.childNodes[3].innerText);
  $('#time').val(event.target.parentNode.parentNode.childNodes[5].innerText);
  $('#informations').val(event.target.parentNode.parentNode.childNodes[7].innerText);

    $('#save-send').click(function(e){
    event.preventDefault();
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
        event.target.parentNode.parentNode.remove();
        $('#sendModal').modal('hide');
      });
  });

}); */
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

@endsection