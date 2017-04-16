  <div class="row clearfix profil-panel" style="background: #fff;">
        <div class="col-md-3 column">
            <img class="img-responsive img-rounded img-thumbnail img-profile" alt="{{$user->first_name}}" src="{{ URL::to('uploads/users')}}/{{$user->image}}"/>
        </div>
        <div class="col-md-3">
            <h2>{{$user->first_name}} {{$user->last_name}}</h2>
    	    <p>{{$user->email}}</p>
   		</div>
        <div class="col-md-6">
                       
            <div class="pull-right">
            @if(Auth::user()->entreprise)    
                <a href="{{route('entreprises.pendingProjects')}}" class="btn btn-default btn-circle btn-xl">
                    <h4 class="fa fa-link fa-lg"></h4></a>
            @endif    
                <a href="{{route('projects.all')}}" class="btn btn-default btn-circle btn-xl">
                <h4 class="fa fa-handshake-o fa-lg"></h4></a>
                <a href="{{route('messages.inbox')}}" class="btn btn-default  btn-circle btn-xl">
                <h4 class="fa fa-envelope fa-lg"></h4></a>
                <a href="{{route('projects.create')}}" class="btn btn-default  btn-circle btn-xl">
                <h4 class="fa fa-plus fa-lg"></h4></a>
            </div>

         </div>
    </div>