//show and hide desktop view tabs based on screen size when website is loaded
$(window).on('load', function() {
  
  if ($(window).width() < 860) {
    $(".tabs").css('display', 'none');    
  } else {
    $(".tabs").css('display', 'block');   
  }
});

//show and hide desktop view tabs and mobile tabs based on screen size when website is resized
$(window).on('resize', function() {
  if ($(window).width() <= 860) {
    $(".tabs").css('display', 'none');
  } else {
    $(".tabs").css('display', 'block');
    $(".mobile_tabs").css('display', 'none');
  }
});

//toggle mobile tabs
$( document ).on('click','#menu', function(){
  $(".mobile_tabs").slideToggle();
  var mobile_tabs = "";
  if ( $('.mobile_tabs').html().length == 0 ) { 
  //copy navigation into mobile tabs container
    $('.tabs').each(function() {
       mobile_tabs += $(this).html();
    });
    $(".mobile_tabs").append(mobile_tabs);
    $(".mobile_tabs a").after('<hr class="hr-text">');
  }
});
