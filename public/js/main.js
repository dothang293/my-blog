$(function(){
    $(window).on('scroll',function(){
        if ( $(this).scrollTop() > 50) {
            $('.navbar').addClass('solid bg-dark');
        } else {
            $('.navbar').removeClass('solid bg-dark');
        }
    });
  
    $('.nav-link').on('click',function(e) {
        if ( this.hash !== ""){
            e.preventDefault();
            const anchor = this.hash;
  
            $('html, body').animate({
                scrollTop: $(anchor).offset().top
            }, function(){
                window.location.hash = anchor;
            });
        }
    });
  });