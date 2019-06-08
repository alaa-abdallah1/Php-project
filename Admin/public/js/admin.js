$(document).ready(function(){


/* General */

$(".navbar li").on({
   
    
    focusin:function(){
        $(this).css("background-color", "red");
    },
    focusout:function(){
        $(this).css("background-color", "#222");
    }
    
}); 


$('input').each(function(){
	if ($(this).attr('required') === 'required' ){
		$(this).after('<span class="star">*</span>')
	}
});


$('.confirm').click( function(){
      return confirm('Are You Sure?');
  });


$('#confirm').click( function(){
      return confirm('Are You Sure?');
  });


/*================================= Admin PAge=================================== */

$("#myModall .closee").click(function(){
    $("#myModall").hide();
});



})






// main page 

  $('.toggle-info').click(function() {
     
     $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

     if ($(this).hasClass('selected')) {
      $(this).html('<i class="fa fa-minus"></i>')
     } else {
        $(this).html('<i class="fa fa-plus"></i>')    
     } 

  });


/*======================slide ==============*/

function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}


/* ================ modal for profile Picture ===============*/ 

// Get the modal
var modal = document.getElementById('picModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
} 

