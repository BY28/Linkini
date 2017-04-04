@extends('layouts.panel.projects')

@section('content')
                
   <div class="row">
   	
   <div class="panel">	
			
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['route' => 'projects.store', 'files'=>true,'class' => 'form-horizontal panel', 'id' => 'project_create_form']) !!}
					<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
						{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
						{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group">
						<label for="select">Secteur d'activité</label>
						<select class="selectpicker form-control" id="select" data-size="10" name="category">
							@foreach($categories as $category)
									 <option>{{$category->name}}</option>
							@endforeach
							</select>

					</div>
					<div class="form-group {!! $errors->has('tags') ? 'has-error' : '' !!}">
					 <div class="tags-input form-control" data-name="tags" id="tags"></div>
						
						{!! $errors->first('tags', '<small class="help-block">:message</small>') !!}
					</div>
					<!-- PAS D'IMAGE POUR LE MOMENT
					<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
					Image :
						{!! Form::file('image', ['class' => 'form-control']) !!}
						{!! $errors->first('image', '<small class="help-block">:project</small>') !!}
					</div>
					-->
					<div class="form-group {!! $errors->has('content') ? 'has-error' : '' !!}">
						{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
						{!! $errors->first('content', '<small class="help-block">:message</small>') !!}
					</div>
					{!! Form::button('Envoyer', ['type' => 'submit', 'class' => 'btn btn-primary pull-right send', 'data-loading-text' => '<i class="fa fa-refresh fa-spin"></i> Creation du projet']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

   </div>

@endsection

@section('scripts')
<script type="text/javascript">
	
$('.send').click(function(event)
{

    var $this = $(this);
    $this.button('loading');

});

$('.tags-input').on('click', function(){
            var input = $(".main-input");
            input.focus();
        });


</script>
@endsection