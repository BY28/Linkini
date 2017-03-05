@extends('layouts.master')

@section('content')
<div style="background-color: #fff">
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$project->title}}
                    <small>{{$project->created_at}}</small>
                </h1>
            </div>
    </div>
    <div class="row">
    	
    	<div class="col-md-8">
                <h3>Description</h3>
                <p>{{$project->content}}</p>        
        </div>
        <div class="col-md-4">
        	
        	<h3>Tags</h3>
                <ul>
                	@foreach($project->tags as $tag)
                    <li>{{$tag->tag}}</li>
                    @endforeach
                </ul>

        </div>

    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
            <span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
        </a>
</div>
@endsection