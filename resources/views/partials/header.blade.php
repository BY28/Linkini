
<style type="text/css">
   span.badge{
  background-color: #ea5817;
}
.notification-title{
  color: #ea5817;
}
</style>

<nav class="navbar navbar-inverse menu">
    <div class="navbar-header" >
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
     <a class="navbar-brand" href="{{route('home')}}">
      <img src="http://img11.hostingpics.net/pics/979426logo2.png" alt="">
    </a>
  </div>
  
  <div class="collapse navbar-collapse js-navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown mega-dropdown">
      <!-- class="dropdown-toggle" data-toggle="dropdown" -->
        <a href="{{route('entreprises.index')}}">Activités</a>
        <!--
        <ul class="dropdown-menu mega-dropdown-menu">
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Men Collection</li>                            
                            <div id="menCollection" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="item active">
                                    <a href="#"><img src="http://placehold.it/254x150/ff3546/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                                    <h4><small>Summer dress floral prints</small></h4>                                        
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>       
                                </div>
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                                    <h4><small>Gold sandals with shiny touch</small></h4>                                        
                                    <button class="btn btn-primary" type="button">9,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>        
                                </div>
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                                    <h4><small>Denin jacket stamped</small></h4>                                        
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>      
                                </div>                              
                              </div>
                             
                              <a class="left carousel-control" href="#menCollection" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#menCollection" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                            <li class="divider"></li>
                            <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Features</li>
              <li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left & Right Navigation</a></li>
              <li><a href="#">Four Columns Grid</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Fonts</li>
                            <li><a href="#">Glyphicon</a></li>
              <li><a href="#">Google Fonts</a></li>
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Plus</li>
              <li><a href="#">Navbar Inverse</a></li>
              <li><a href="#">Pull Right Elements</a></li>
              <li><a href="#">Coloured Headers</a></li>                            
              <li><a href="#">Primary Buttons & Default</a></li>              
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
              <li><a href="#">Calls to action</a></li>
              <li><a href="#">Custom Fonts</a></li>
              <li><a href="#">Slide down on Hover</a></li>                         
            </ul>
          </li>
        </ul>
        -->       
      </li>
            <li class="dropdown mega-dropdown">
          <a href="{{route('projects.index')}}" >Projets</a>
        <!--
        <ul class="dropdown-menu mega-dropdown-menu">
          <li class="col-sm-3">
              <ul>
              <li class="dropdown-header">Features</li>
              <li><a href="#">Auto Carousel</a></li>
                            <li><a href="#">Carousel Control</a></li>
                            <li><a href="#">Left & Right Navigation</a></li>
              <li><a href="#">Four Columns Grid</a></li>
              <li class="divider"></li>
              <li class="dropdown-header">Fonts</li>
                            <li><a href="#">Glyphicon</a></li>
              <li><a href="#">Google Fonts</a></li>
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Plus</li>
              <li><a href="#">Navbar Inverse</a></li>
              <li><a href="#">Pull Right Elements</a></li>
              <li><a href="#">Coloured Headers</a></li>                            
              <li><a href="#">Primary Buttons & Default</a></li>              
            </ul>
          </li>
          <li class="col-sm-3">
            <ul>
              <li class="dropdown-header">Much more</li>
                            <li><a href="#">Easy to Customize</a></li>
              <li><a href="#">Calls to action</a></li>
              <li><a href="#">Custom Fonts</a></li>
              <li><a href="#">Slide down on Hover</a></li>                         
            </ul>
          </li>
                    <li class="col-sm-3">
              <ul>
              <li class="dropdown-header">Women Collection</li>                            
                            <div id="womenCollection" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="item active">
                                    <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                                    <h4><small>Summer dress floral prints</small></h4>                                        
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>       
                                </div>
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/ff3546/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                                    <h4><small>Gold sandals with shiny touch</small></h4>                                        
                                    <button class="btn btn-primary" type="button">9,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>        
                                </div>
                                <div class="item">
                                    <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                                    <h4><small>Denin jacket stamped</small></h4>                                        
                                    <button class="btn btn-primary" type="button">49,99 €</button> <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>      
                                </div>                             
                              </div>
                             
                               <a class="left carousel-control" href="#womenCollection" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="right carousel-control" href="#womenCollection" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                            <li class="divider"></li>
                            <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
            </ul>
          </li>
        </ul> 
        -->      
      </li>
            <li><a href="#">Services</a></li>
    </ul>
        <ul class="nav navbar-nav navbar-right">
        <!-- recherche 

          <form class="navbar-form navbar-left" role="search" id="custom-search-input">
            <div class="form-group">
              <input type="text" class="form-control search-query" placeholder="Recherche">
            </div>
            <button type="submit" class="btn btn-default"><i class="fa fa-search fa-lg"></i></button>
          </form>
        -->
      
        @if (Auth::guest())
           
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>CONNEXION</b> </a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                     <div class="row">
                            <div class="col-md-12">
                                 <form class="form" role="form" method="POST" action="{{ url('/login') }}" accept-charset="UTF-8" id="login-nav">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="email">E-Mail Address</label>

                                            <div>
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="sr-only" for="password">Password</label>

                                            <div>
                                                <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                             <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                                        </div>
                                 </form>
                            </div>
                            <div class="bottom text-center">
                                Vous n'êtes pas inscrit ? <a href="{{ url('/register') }}"><b>Rejoignez nous</b></a>
                            </div>
                     </div>
                </li>
            </ul>
        </li>
     
        @else
        <!-- ajout de mon code --> 

        <li class="dropdown">
          <a href="#" class="fa fa-envelope fa-lg" class="dropdown-toggle" data-toggle="dropdown">
            @if(Auth::user()->getUnreadMessagesNum()>0)
            <span class="badge">{{Auth::user()->getUnreadMessagesNum()}}</span>
            @endif
          </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="{{route('messages.create')}}">Nouveau Message</a></li>
              <li><a href="{{route('messages.inbox')}}">Message reçus</a></li>
              <li><a href="{{route('messages.sent')}}">Message envoyés</a></li>
            </ul>
        </li>

      <li class="dropdown">
          <a href="#" class="fa fa-bell fa-lg" class="dropdown-toggle" data-toggle="dropdown">
          @if(Auth::user()->notifications->where('seen', false)->count())
          <span class="badge">{{Auth::user()->notifications->where('seen', false)->count()}}
          </span>
            @endif
            </a>
            <ul class="dropdown-menu multi-level scrollable-menu pre-scrollable" role="menu" aria-labelledby="dropdownMenu">

              @foreach(Auth::user()->notifications->reverse() as $notification)
                @if(!$notification->seen)

                  <li>
                    <a href="{{route('projects.show', $notification->project_id)}}"> 
                    
                    <div class="notification-title">{{ $notification->title }}</div>
                    <p>{{$notification->content}}</p>

                    </a>
                  </li>
                @endif
              @endforeach
              @if(Auth::user()->notifications->where('seen', false)->count() <= 0)
                <li>
                  <a href="{{route('profile.notifications')}}">
                     <div class="notification-title">Voir toutes les notifications</div>
                     <p>Pas de nouvelles notifications.</p>
                  </a>
                 </li>
              @endif
            </ul>
        </li>
         
        <li class="dropdown">
          <a href="#" class="fa fa-plus fa-lg" class="dropdown-toggle" data-toggle="dropdown"> </a>
           <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="{{route('projects.create')}}" target="_blank">Créer un projet</a></li>
              <li><a href="{{route('entreprises.getorder')}}">Créez votre activité</a></li>
            </ul>
          
        </li>

        <li class="dropdown">
          <a href="#" class="fa fa-user fa-lg" class="dropdown-toggle" data-toggle="dropdown"> </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
              <li class="dropdown-submenu">
                <a tabindex="-1" href="{{route('profile.index')}}">Mon Profil</a>
              </li>
              <li class="divider"></li>
              <li><a href="{{route('projects.all')}}">Mes Projets</a></li>
              <li><a href="{{route('entreprises.pendingProjects')}}">Mon Entreprise</a></li>
              <li><a href="{{route('profile.favorites')}}">Mes Favoris</a></li>
              <li><a href="#">Mes Statistiques</a></li>
              @if(Auth::user()->admin)
                <li class="divider"></li>
                  <li><a href="{{route('admins.index')}}">Administration</a></li>
              @endif
             <li class="divider"></li>
              <li class="dropdown-submenu">
                <a tabindex="-1" href="{{route('settings.account')}}">Paramètres</a>
              </li>
            </ul>
        </li>

         <li class="dropdown">
           <a class="fa fa-sign-out fa-lg" href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  
              </a>

              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>

     <!-- fin -->
      
        @endif
      </ul>
  </div><!-- /.nav-collapse -->
  </nav>