
  // main page 

  $('.toggle-info').click(function() {
     
     $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

     if ($(this).hasClass('selected')) {
      $(this).html('<i class="fa fa-minus"></i>')
     } else {
        $(this).html('<i class="fa fa-plus"></i>')    
     } 

  });

  
/*============================== Shop PAge =====================*/
  
  
  
  
  /* login and sign up page */

$("div.signup").css('display', 'none');

$(".up").click(function(){
    $("div.login").hide();
    $("div.signup").show();
});

$(".in").click(function(){
    $("div.login").show();
    $("div.signup").hide();
});


$('.sign .in').click(function () {
   
   $('.sign .in').addClass('selecta');
   $('.sign .up').removeClass('selectb');
});

$('.sign .up').click(function () {
   
   $('.sign .up').addClass('selectb');
   $('.sign .in').removeClass('selecta');
});




/* ads page */

$('.live').keyup(function () {

  $($(this).data('class')).text($(this).val())

});
