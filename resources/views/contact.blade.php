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

.btn-info:active
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
<link rel="stylesheet" href="{{ URL::to('src/css/contact.css') }}">
@endsection

@section('banner')
<header class="banner">

                       <div class="container">
                            <div class="row">
                               <div class="col-md-6 col-md-offset-4">
                                    <h1 class="tagline">Contactez-nous !</h1>
                                </div>
                            </div>

                            <div class="row">
                             <div class="col-md-7 col-md-offset-3">
                                <h3 style="color: #fff; text-shadow: 0 0 20px #000">Vous cherchez des informations supplémentaires, propositions ou commentaire ? Contactez-nous dès maintenant!</h3>
                            </div>
                            </div>
                        </div>

</header>
<div class="content_top">
      <div class="container">
         <div class="row">    
        <div class="col-xs-12 search-container">
        <form action="{{route('postSearch')}}" method="POST" id="post_search">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <select class="selectpicker" id="select" name="filter">
                              <option class="search-option">Secteur d'activité</option>
                              <option class="search-option">Projets</option>
                        </select>
                </div>    
                <div class="tags-input form-control" data-name="tags" id="tags"></div>
                <input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un secteur d'activité" autocomplete="off">
                <input type="hidden" name="tags-input" id="hidden-tag">
                   <ul class="list-group search-results">
                       <!--  <li class="list-group-item list-group-item-linkable"></li> -->
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


@section('addContent')

  <div class="agileits_mail_grids"> 
    <div class="col-md-7 mail_left">
      <div id="map"></div>
    </div>
    <div class="col-md-5 mail_right">
      <h3>Contact Info</h3>
      <ul>
        <li><span><i class="fa fa-home" aria-hidden="true"></i>Address<label>:</label></span> 00 rue adresse, Alger.</li>
        <li><span><i class="fa fa-phone" aria-hidden="true"></i>Phone<label>:</label></span> 0123456789</li>
        <li><span><i class="fa fa-fax" aria-hidden="true"></i>Fax<label>:</label></span> 0123456789</li>
        <li><span><i class="fa fa-envelope" aria-hidden="true"></i>Email<label>:</label></span> <a href="mailto:contact@linkini.com">contact@linkini.com</a></li>
      
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
  
  <div class="banner-bottom">
    <div class="container">
      <h3 class="wthree_head">Restez en contact!</h3>
        <p class="agileits_para agile_para">Envoyez nous votre message, commentaire ou requête.</p>
      <div class="agileinfo_mail_grids">
        <form action="{{route('sendContactEmail')}}" method="post">
          <span class="input input_">
            <input class="input__field input__field_" name="name" type="text" placeholder="Nom Prénom" required="" />
           <!-- <label class="input__label input__label_" for="input-13">
              <span class="input__label-content input__label-content_" data-content="Name">Nom</span>
            </label>-->
          </span>
          <span class="input input_">
            <input class="input__field input__field_" name="email" type="email" placeholder="Email" required="" />
           <!-- <label class="input__label input__label_" for="input-14">
              <span class="input__label-content input__label-content_" data-content="Email">Email</span>
            </label>-->
          </span>
          <span class="input input_">
            <input class="input__field input__field_" name="subject" type="text" placeholder="Sujet" required="" />
           <!-- <label class="input__label input__label_" for="input-15">
              <span class="input__label-content input__label-content_" data-content="Subject">Sujet</span>
            </label>-->
          </span>
          <textarea name="content" placeholder="Message..." required=""></textarea>
          {{csrf_field()}}
          <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
$('.tags-input').hide();


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
    }, 100);
  })

  $('.main-input').on('keyup', function(){
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
           var value=$(".main-input").val().replace('/\s/g','');
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
    }, 100);
  })

/* SEARCH */
$(document).ready(function() {

  $('#select').change(function(){

      if($('#select').val() == 'Secteur d\'activité')
      {
        $('#search').prop("placeholder", "Rechercher un secteur d'activité");
        $('.tags-input').hide();
        $('#search').show();

        $('.search-results').on('click', function(){
           var input = $("#search");
            input.focus();
        });
      }
      else
      {
        $('#search').prop("placeholder", "Mot clé pour la recherche d'un projet (plomberie,construction,électricité...)");
        $('#search').hide();
        $('.tags-input').show();

        $('.tags-input').on('click', function(){
            var input = $(".main-input");
            input.focus();
        });

        $('.search-results').on('click', function(){
           var input = $(".main-input");
            input.focus();
        });
      }
  });
});
</script>
<script type="text/javascript">
    function initMap() {
        // Create a map object and specify the DOM element for display.
        var myLatLng = {lat:36.75, lng: 3.04};

        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 6
        });

        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng
        });

          

           
     
                  var marker = new google.maps.Marker({
                        map: map,
                        position: {
                            lat:36.75,
                            lng:3.04
                        }
                      });
            
                      
         

         
      }

   </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJxWQIPOiN1AIGCG4-mp308Mv0hXQYcm0&callback=initMap"></script>

@endsection