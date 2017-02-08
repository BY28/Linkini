@extends('layouts.master')

@section('title')
Entreprises
@endsection

@section('content')

@foreach($entreprises->chunk(3) as $entrepriseChunk)

  <div class="row-eq-height">

    @foreach($entrepriseChunk as $entreprise)
      
      <div class="col-md-3">
        <div class="thumbnail">
          <img src="{{ URL::to('uploads/business')}}/{{$entreprise->image}}" class="img-responsive" alt="...">
          <div class="caption">
            <h3>{{ $entreprise->name }}</h3>
            <p class="description">{{ $entreprise->description }}</p>
            <div class="clearfix">
              <div class="pull-left link">13 Link(s)</div>
              <a href="#" class="btn btn-success pull-right" role="button"><i class="fa fa-handshake-o" aria-hidden="true"></i> Link</a>
            </div>
          </div>
        </div>
      </div>
    
    @endforeach
    @if(Auth::check() and Auth::user()->admin)

      {!! link_to_route('entreprise.create', 'Ajouter une entreprise', [], ['class' => 'btn btn-info pull-right']) !!}
    
    @endif

    {!! $links !!}
  </div>

@endforeach

@endsection