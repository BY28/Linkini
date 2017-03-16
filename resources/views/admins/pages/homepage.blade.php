@extends('layouts.admin.index')

@section('content')
    <div class="row">
       {!! Form::open(array('route' => 'homepage.storeCarousel', 'class' => 'form', 'files' => true, 'method' => 'post')) !!}

      <div class="form-group">
          {!! Form::label('Pub Image') !!}
          {!! Form::file('image', null) !!}
      </div>

      <div class="form-group">
          {!! Form::submit('Add!', ['class' => 'btn btn-primary']) !!}
      </div>

      {!! Form::close() !!}    
    </div>

    <div class="row">
      @foreach($carouselImages as $carouselImage)
        <div class="col-md-3" data-imageid="{!! $carouselImage->id !!}">
          <img src="{{ URL::to('uploads/homepage')}}/{{$carouselImage->image}}" class="img-responsive">
          <!-- <a href="#" class="btn btn-danger btn-xs delete" data-toggle="modal" 
   data-target="#deleteModal">Delete</a> -->
   {!! Form::open(['method' => 'DELETE', 'route' => ['homepage.deleteCarousel', $carouselImage->id]]) !!}
                                    {!! Form::button(' <span class="glyphicon glyphicon-trash"></span>', ['class' => 'btn btn-danger btn-xs pull-right', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
        </div>
      @endforeach
    </div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="favoritesModalLabel">Delete Carousel Image</h4>
      </div>
      <p> Etes vous sur de vouloir supprimer cette image ?</p>
      <img src="" id="delete-img" class="img-responsive">
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="button" class="btn btn-primary" id="save-delete">
            Delete
          </button>
        </span>
      </div>
    </div>
  </div>
</div>

 

@endsection 

@section('scripts')
<script>

$('.delete').click(function(event) {
  
  var imageSrc = event.target.parentNode.childNodes[1].src;
  var imageId = event.target.parentNode.dataset['imageid'];

  $("#delete-img").attr('src', imageSrc);

    $('#save-delete').click(function(e){
    event.preventDefault();
       
      var token = '{{Session::token()}}';
      var urlImg = '';

      $.ajax({
          method: 'DELETE',
          url: urlImg,
          data: {imageId: imageId,  _token: token}

      })
      .done(function(){

           event.target.parentNode.remove();
           $('#deleteModal').modal('hide');

      });
  });

});


</script>

@endsection