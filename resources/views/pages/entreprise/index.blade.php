@extends('layouts.pages.master')

@section('title')
{{$entreprise->name}}
@endsection

@section('styles')
<link rel="stylesheet" href="{{ URL::to('src/pages/entreprise/css/style.min.css') }}">
@endsection

@section('header')
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">{{$entreprise->name}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">A propos</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
@endsection

@section('banner')
    <header>
        <div class="header-content">
            <div class="header-content-inner">

                <h1 id="homeHeading">{{$header_content[0]->content_title}}</h1>
                <hr>
                <p>{{$header_content[0]->content_text}}</p>
                <a href="#about" class="btn btn-primary btn-md page-scroll">
                    <i class="fa fa-angle-double-down fa-2x"></i>
                </a>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">{{$about_content[0]->content_title}}</h2>
                    <hr class="light">
                    <p class="text-faded">{{$about_content[0]->content_text}}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($services_content as $service)
                     <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <h3>{{$service->content_title}}</h3>
                            <p class="text-muted">{{$service->content_text}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">{{$contact_content[0]->content_title}}</h2>
                    <hr class="primary">
                    <p>{{$contact_content[0]->content_text}}</p>
                </div>
            </div>
            <div class="row">
    <div class="col-sm-5">
      <p><span class="glyphicon glyphicon-map-marker"></span> {{$entreprise->address}}</p>
      <p><span class="glyphicon glyphicon-phone"></span> {{$entreprise->phone}}</p>
      <p><span class="glyphicon glyphicon-envelope"></span> {{$entreprise->email}}</p>
    </div>
    <div class="col-sm-7 slideanim">
        <form action="{{route('sendPageContactEmail')}}" method="POST">
          <div class="row">      
            <div class="col-sm-6 form-group">
              <input class="form-control" id="name" name="name" placeholder="Nom" type="text" required>
            </div>
            <div class="col-sm-6 form-group">
              <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
            </div>
          </div>
          <textarea class="form-control" id="comments" name="content" placeholder="Message..." rows="5"></textarea><br>
          {{csrf_field()}}
          <input type="hidden" name="entreprise_email" value="{{$entreprise->email}}">
          <div class="row">
            <div class="col-sm-12 form-group">
              <button class="btn btn-primary pull-right" type="submit">Envoyer</button>
            </div>
          </div>
        </form>
    </div>
  </div>
        </div>
    </section>
@endsection

@section('footer')
    <footer class="container-fluid text-center">
  <a href="#page-top" class="page-scroll" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Développé par <a href="https://www.linkini.dev" title="Visiter linkini">www.linkini.com</a></p> 
</footer>
@endsection

@section('scripts')
<script src="{{ URL::to('src/pages/entreprise/js/functions.min.js') }}"></script>
<script src="{{ URL::to('src/js/jquery.easing.min.js') }}"></script>
@endsection