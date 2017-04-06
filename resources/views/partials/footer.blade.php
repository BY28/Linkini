<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> ACTIVITÉS </h3>
                    <ul>
                        <li> <a href="{{route('entreprises.index')}}"> Les activités </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> PROJETS </h3>
                    <ul>
                        <li> <a href="{{route('projects.index')}}"> Les projets </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> Services </h3>
                    <ul>
                        <li> <a href="{{route('services')}}"> Nos offres </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> CONTACT </h3>
                    <ul>
                        <li> <a href="{{route('contact')}}"> Contact </a> </li>
                        <li> <i class="fa fa-phone" aria-hidden="true"></i> 0123456789 </li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i> contact@linkini.com </li>
                        <li> <i class="fa fa-home" aria-hidden="true"></i> 00 adresse rue </li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    <h3> NEWSLETTER </h3>
                    <ul>
                        <li>
                            <div class="input-append newsletter-box text-center">
                            <form action="{{route('storeEmail')}}" method="POST">        
                                <input type="text" name="email" class="full text-center form-control" placeholder="Email ">
                                <button class="btn  btn-lg newsletter-send" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Envoi de l'e-mail" type="submit"> Envoyer <i class="fa fa-long-arrow-right"> </i> </button>
                                {{csrf_field()}}
                            </form>
                            </div>
                        </li>
                    </ul>
                    <ul class="social">
                        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                    </ul>
                </div>
            </div>
            <!--/.row--> 
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © <span id="copyright">Linkini</span> 2017. All right reserved. </p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">

                </ul> 
            </div>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>