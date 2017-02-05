@extends('layouts.master')

@section('title')
Demandes
@endsection

@section('content')

    @if(isset($info))
        <div class="row alert alert-info">{{ $info }}</div>
    @endif

<div class="row">
        <div class="panel panel-default widget">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    Demandes</h3>
                <span class="label label-info">
                    ...</span>
            </div>
            <div class="panel-body">
                <ul class="list-group">

@foreach($demands as $demand)

      
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="#">{{ $demand->title }}</a>
                                    <div class="pull-right">
                                        @foreach($demand->tags as $tag)
                                            {!! link_to('demand/tag/' . $tag->tag_url, $tag->tag, ['class' => 'btn btn-xs btn-info']) !!}
                                        @endforeach
                                    </div>
                                    <div class="mic-info">
                                        By: <a href="#">{!! $demand->user->email !!}</a> date: {!! $demand->created_at->format('d-m-Y') !!}
                                       
                                    </div>
                                </div>
                                <div class="comment-text">
                                    {{ $demand->content }}
                                </div>
                                <div class="action">

                                    <a href="{{route('demand.edit', [$demand->id])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                   
                                    <button type="button" class="btn btn-success btn-xs" title="Approved">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['demand.destroy', $demand->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </li>
    
    @endforeach

                  </ul>
                <a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
            </div>
        </div>
    </div>
    @if(Auth::check() and Auth::user()->admin)

      {!! link_to_route('demand.create', 'Ajouter une demande', [], ['class' => 'btn btn-info pull-right']) !!}
    
    @endif

    {!! $links !!}
  </div>

@endsection