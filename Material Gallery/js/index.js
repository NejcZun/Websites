$(document).ready(function(){
	(function($) {
		$('#header_icon').click(function(e){
			e.preventDefault(); //da se url ne odpre https://www.w3schools.com/jquery/event_preventdefault.asp
			$('body').toggleClass('with--sidebar');
		});
    $('#site-cache').click(function(e){
      $('body').removeClass('with--sidebar');
    });
	})(jQuery);
});