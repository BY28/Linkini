jQuery(document).on('click', '.dropdown', function(e) {
  e.stopPropagation()
});

    $(document).ready(function() {  
  		 $(".carousel-inner").swiperight(function() {  
    		  $(this).parent().carousel('prev');  
	    		});  
		   $(".carousel-inner").swipeleft(function() {  
		      $(this).parent().carousel('next');  
	   });  
	}); 
/*
	 $(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});
*/

