@extends('layouts.panel.entreprise_projects')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($links as $link)
               
                    <tr class="clickable-row" data-href="{{route('projects.show', $link->project->id)}}" data-projectid="{{$link->project->id}}">   
                        <td class="view-message  dont-show">{{$link->project->title}}</td>
                        <td class="view-message ">{{$link->project->content}}</td>
                        <td class="view-message  text-right">{{$link->created_at}}</td>
                        <!-- <td><a href="#" class="launch">Launch</a></td> -->
                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>

@endsection

@section('scripts')

<script>

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

</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

@endsection