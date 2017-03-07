@extends('layouts.panel.index')

@section('content')
                
   <div class="row">

	 <div class="mail-box">
                 
        <aside class="lg-side">
            <div class="inbox-body">
                         
                <table class="table table-inbox table-hover">
                  <tbody>
                  @foreach($favorites as $favorite)
               
                    <tr class="clickable-row" data-href="{{route('entreprises.show', $favorite->entreprise_id)}}">   
                        <td class="view-message  dont-show">{{$favorite->entreprise->name}}</td>
                        <td class="view-message ">{{$favorite->entreprise->description}}</td>

                    </tr>
                   
                   @endforeach
                </tbody>
                </table>
            </div>
        </aside>
    </div>
   </div>
@endsection