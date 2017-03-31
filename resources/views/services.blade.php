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
<link rel="stylesheet" href="{{ URL::to('src/css/services.css') }}">
@endsection

@section('banner')

<header class="banner">

                       <div class="container">
                            <div class="row">
                               <div class="col-md-6 col-md-offset-4">
                                    <h1 class="tagline">Nos offres !</h1>
                                </div>
                            </div>

                            <div class="row">
                             <div class="col-md-7 col-md-offset-4">
                                <h3 style="color: #fff; text-shadow: 0 0 20px #000">Choisissez l'une de nos différentes offres!</h3>
                                <h3 style="color: #fff; text-shadow: 0 0 20px #000">Chaque offre a son avantage, abonnez vous à l'une d'entre elle pour en bénéficier.</h3>
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

<div class="row pricing-section">
                <!-- item -->
<div class="col-md-3 col-sm-3 col-xs-12 text-center">
<div class="panel panel-pricing">
<div class="panel-heading">
<i class="fa fa-paper-plane"></i>
<h3>Offre 1</h3>
</div><!--panel-heading close-->
<div class="panel-body text-center">
<p class="p-title">Subscription Duration</p><!--p-title close-->
<p class="p-time">2 days - 30 Mins</p><!--p-time close-->
</div><!--panel-body text-center close-->
<div class="panel-body text-center">
<p class="p-price">₦ 50.00 </p><!--p-price close-->
<p class="p-tax">All inclusive</p><!--p-tax close-->
</div><!--panel-body text-center close-->
<div class="panel-footer">
<a class="btn sub-btn" href="#">Subscribe Now</a>
</div>
</div><!--panel panel-pricing close-->
</div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->


<div class="col-md-3 col-sm-3 col-xs-12 text-center">
<div class="panel panel-pricing">
<div class="panel-heading">
<i class="fa fa-plane"></i>
<h3>Offre 2</h3>
</div><!--panel-heading close-->
<div class="panel-body text-center">
<p class="p-title">Subscription Duration</p><!--p-title close-->
<p class="p-time">7 days - 90 Mins</p><!--p-time close-->
</div><!--panel-body text-center close-->
<div class="panel-body text-center">
<p class="p-price">₦ 150.00 </p><!--p-price close-->
<p class="p-tax">All inclusive</p><!--p-tax close-->
</div><!--panel-body text-center close-->
<div class="panel-footer">
<a class="btn sub-btn" href="#">Subscribe Now</a>
</div>
</div><!--panel panel-pricing close-->
</div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->



<div class="col-md-3 col-sm-3 col-xs-12 text-center">
<div class="panel panel-pricing">
<div class="panel-heading">
<i class="fa fa-space-shuttle"></i>
<h3>Offre 3</h3>
</div><!--panel-heading close-->
<div class="panel-body text-center">
<p class="p-title">Subscription Duration</p><!--p-title close-->
<p class="p-time">30 days - 250 Mins</p><!--p-time close-->
</div><!--panel-body text-center close-->
<div class="panel-body text-center">
<p class="p-price">₦ 400.00 </p><!--p-price close-->
<p class="p-tax">All inclusive</p><!--p-tax close-->
</div><!--panel-body text-center close-->
<div class="panel-footer">
<a class="btn sub-btn" href="#">Subscribe Now</a>
</div>
</div><!--panel panel-pricing close-->
</div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->

<div class="col-md-3 col-sm-3 col-xs-12 text-center">
<div class="panel panel-pricing">
<div class="panel-heading">
<i class="fa fa-rocket"></i>
<h3>Offre 4</h3>
</div><!--panel-heading close-->
<div class="panel-body text-center">
<p class="p-title">Subscription Duration</p><!--p-title close-->
<p class="p-time">30 days - 250 Mins</p><!--p-time close-->
</div><!--panel-body text-center close-->
<div class="panel-body text-center">
<p class="p-price">₦ 400.00 </p><!--p-price close-->
<p class="p-tax">All inclusive</p><!--p-tax close-->
</div><!--panel-body text-center close-->
<div class="panel-footer">
<a class="btn sub-btn" href="#">Subscribe Now</a>
</div>
</div><!--panel panel-pricing close-->
</div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->

</div><!--row close-->




@endsection

@section('addContent')
<div class="pricing-compare">
<div class="container">

<div class="table-responsive pricing-table">

            <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Comparer les offres</th>
                <th>Offre 1</th>
                <th>Offre 2</th>
                <th>Offre 3</th>
                <th>Offre 4</th>
              </tr>
             </thead>
              <tbody>
               
                  <tr>
                      <td>Envoi de notes d'interet:</td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                  </tr>
                  <tr>
                      <td>Pubs:</td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                  </tr>
                  <tr>
                      <td>Support:</td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                  </tr>
                  <tr>
                      <td>Réseau d'activités:</td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                  </tr>
                  <tr>
                      <td>Notifications par mails:</td>
                      <td><span class="fa fa-times fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                      <td><span class="fa fa-check fa-lg"></span></td>
                  </tr>
                  <tr>
                      <td>Statistiques:</td>
                      <td>20</td>
                      <td>50</td>
                      <td>80</td>
                      <td>200</td>
                  </tr>
                  <tr>
                      <td>Page web:</td>
                      <td>1</td>
                      <td>10</td>
                      <td>20</td>
                      <td>unlimited</td>
                  </tr>
                  <tr>
                  <td></td>
                      <td>
                          <a class="btn btn-success">
                              Upgrade
                          </a>
                      </td>
                      <td>
                          <a class="btn btn-success">
                              Upgrade
                          </a>
                      </td>
                      <td>
                          <a class="btn btn-success">
                              Upgrade
                          </a>
                      </td>
                      <td>
                          <a class="btn btn-success">
                              Upgrade
                          </a>
                      </td>
                  </tr>
              </tbody>
        </table>

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
@endsection