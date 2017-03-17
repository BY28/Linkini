@extends('layouts.master')

@section('styles')

<style type="text/css">
.navbar{
  margin-bottom: 0em;
}

.banner{
    margin-bottom: 0em;
}

button.btn.btn-default.dropdown-toggle, button.btn.btn-default{
    background-color: #ea5817;
    color: #fff;
}

button.btn.btn-default.dropdown-toggle:active, button.btn.btn-default:active{
    background-color: #ea5817;
    color: #fff;
}

button.btn.btn-default.dropdown-toggle:hover, button.btn.btn-default:hover{
    background-color: #ea5817;
    color: #fff;
}

.content_top{
    margin-bottom: 1em;
}

.btn-lg
{
    border-radius: 0px;
    background-color: #ea5817;
    border: none;
}

.btn-lg:hover
{
    border-radius: 0px;
    background-color: #f96625;
    border: none;
}

.btn-lg:active
{
    border-radius: 0px;
    background-color: #ea5817;
    border: none;
}

.search-results{
  position: absolute;
  top: 100%;
   z-index: 20;
}
.search-container
{
  position: relative;
}

/* SEARCH RESULT LIST*/
.list-group-item-linkable:hover {
    color: #555;
    text-decoration: none;
    background-color: #f5f5f5;
    cursor: pointer;
}
.search-results{
    max-height: 325px;
    overflow-y:scroll; 
}
</style>

@endsection

@section('banner')

<header class="banner">
        
       
        <!--    
            
        -->

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides --> 
              <div class="carousel-inner" id="header-carousel-inner" role="listbox">
                
                     
                    <div class="item active">
                         <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-4">
                                    <h1 class="tagline">Améliorez votre activité !</h1>
                                    
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-7 col-md-offset-3">
                                <h3 style="color: #fff; text-shadow: 0 0 20px #000">Les clients viennent a vous sur linkini ! Commencez votre business des maintenant.</h3>
                            </div>
                            </div>
                            <div class="row">
                                
                                 <div class="col-md-4 col-md-offset-3">
                                     {!! link_to_route('entreprises.getorder', 'Commencer!', [], ['class' => 'btn btn-info pull-right btn-lg']) !!}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="item">
                       <div class="container">
                            <div class="row">
                               <div class="col-md-6 col-md-offset-4">
                                    <h1 class="tagline">Concrétisez vos projets !</h1>
                                </div>
                            </div>

                            <div class="row">
                             <div class="col-md-7 col-md-offset-4">
                                <h3 style="color: #fff; text-shadow: 0 0 20px #000">Réalisez tous vos projets dès maintenant !</h3>
                            </div>
                            </div>

                            <div class="row">
                                 <div class="col-md-4 col-md-offset-3">
                                     {!! link_to_route('projects.create', 'Réaliser!', [], ['class' => 'btn btn-info pull-right btn-lg']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                       <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-5">
                                    <h1 class="tagline">Gagnez plus !</h1>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-8 col-md-offset-3">
                                 <h3 style="color: #fff; text-shadow: 0 0 20px #000">Rentabilisez votre temps en gagnant plus à tous les niveaux!</h3>
                                </div>
                            </div>
                              <div class="row">
                                 <div class="col-md-4 col-md-offset-3">
                                     {!! link_to_route('entreprises.getorder', 'Services', [], ['class' => 'btn btn-info pull-right btn-lg']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                 
              </div>

            
            </div>

</header>
<div class="content_top">
      <div class="container">
         <div class="row">    
        <div class="col-xs-8 col-xs-offset-2 search-container">
        <form action="{{route('postSearch')}}" method="POST">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <select class="selectpicker" id="select" name="filter">
                              <option class="search-option">Secteur d'activité</option>
                              <option class="search-option">Projets</option>
                        </select>
                </div>    
                <input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un secteur d'activité" autocomplete="off">
                   <ul class="list-group search-results">
             <!--  <li class="list-group-item list-group-item-linkable">Cras justo odio</li>
             <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li> -->
            </ul>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
            {{csrf_field()}}
        </form>
        </div>
    </div>
    </div>
   </div>

@endsection

@section('content')

<div class="row carousel-holder">

                     <div class="col-md-6">
                        <div id="carousel-example-generic-top" class="carousel slide shadow-box" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic-top" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic-top" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic-top" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="img-responsive" src="http://lorempixel.com/750/500/" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive" src="http://lorempixel.com/750/500/" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive" src="http://lorempixel.com/750/500/" alt="">
                                </div>
                            </div>

                            <!-- Controls -->
                                          </div>
                    </div>

                    <!-- Service Tabs -->
        <div class="col-md-6 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="glyphicon glyphicon-link"></h4><br/>Linki
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-time"></h4><br/>Timi
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-export"></h4><br/>Partagi
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-saved"></h4><br/>Assuri
                </a>
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                    <center>
                      <h1 class="glyphicon glyphicon-link" style="font-size:14em;color:#a9a9a9"></h1>
                      <h2 style="margin-top: 0;color:#a9a9a9">Créez des liens!</h2>
                      <p style="margin-top: 0;color:#a9a9a9">Linkini vous donne la possibilité de créer des liens avec plusieurs entreprises afin de réaliser vos projets</p>
                    </center>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-time" style="font-size:12em;color:#a9a9a9"></h1>
                      <h2 style="margin-top: 0;color:#a9a9a9">Gagnez du temps!</h2>
                      <p style="margin-top: 0;color:#a9a9a9">Retrouvez rapidement, efficacement et en un clic l'entreprise ou le projet que vous cherchez</p>
                    </center>
                </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-export" style="font-size:12em;color:#a9a9a9"></h1>
                      <h2 style="margin-top: 0;color:#a9a9a9">Soyez visible!</h2>
                      <p style="margin-top: 0;color:#a9a9a9">Ajoutez de la visibilité à votre projet ou votre entreprise en partageant sur les réseaux sociaux et en vous créant une page personnalisé</p>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-saved" style="font-size:12em;color:#a9a9a9"></h1>
                      <h2 style="margin-top: 0;color:#a9a9a9">Echangez en sécurité!</h2>
                      <p style="margin-top: 0;color:#a9a9a9">En vous connectant sur linkini vous êtes assuré d'avoir un échange professionnel avec des entreprises certifiés pour plus de fiabilité</p>
                    </center>
                </div>
                
            </div>
        </div>

     </div>
     <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>
                    Carousel Product Cart Slider</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example" class="carousel slide" data-interval="false">
        <!-- CONTAINER -->
        <div class="container">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product Example</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Next Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Grouped Product</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        </div>
        <!-- -->
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-9">
                <h3>
                    Carousel Product Cart Slider</h3>
            </div>
            <div class="col-md-3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs">
                    <a class="left fa fa-chevron-left btn btn-primary" href="#carousel-example-generic"
                        data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-primary" href="#carousel-example-generic"
                            data-slide="next"></a>
                </div>
            </div>
        </div>
        <div id="carousel-example-generic" class="carousel slide" data-interval="false">
<!-- CONTAINER -->
        <div class="container">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product Example</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Next Sample Product</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $199.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Grouped Product</h5>
                                            <h5 class="price-text-color">
                                                $249.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="col-item">
                                <div class="photo">
                                    <img src="http://lorempixel.com/750/500/" class="img-responsive" alt="a" />
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="price col-md-6">
                                            <h5>
                                                Product with Variants</h5>
                                            <h5 class="price-text-color">
                                                $149.99</h5>
                                        </div>
                                        <div class="rating hidden-sm col-md-6">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="separator clear-left">
                                        <p class="btn-add">
                                            <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>
                                        <p class="btn-details">
                                            <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        </div>
        <!-- -->
    </div>

@endsection

@section('scripts')
<script type="text/javascript">

    
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

/* SEARCH */
$(document).ready(function() {

  $('#select').change(function(){

      if($('#select').val() == 'Secteur d\'activité')
      {
        $('#search').prop("placeholder", "Rechercher un secteur d'activité");
      }
      else
      {
        $('#search').prop("placeholder", "Mot clé pour la recherche d'un projet (plomberie,construction,électricité...)");
      }
  });

  $('#search').on('keyup', function(){
      var timer;
      $value = $(this).val();
      $filter = $('#select').val();

      clearTimeout(timer);  
      timer = setTimeout(function() {
      $.ajax({
        type : 'GET',
        url : '{{URL::to('search')}}',
        data : {'search': $value, 'filter': $filter},
        success:function(data){
          var value=$.trim($("#search").val());
          if(value.length>0)
          {
            if(data.no != "")
            {
              $('.search-results').html(data);
            }
          }
          else
          {
            $('.search-results').empty();
          }
        }
      });
    }, 500);
  })

});

</script>
@endsection