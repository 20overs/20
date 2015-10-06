new WOW().init();

$(document).ready(function(){
	$(".button-collapse").sideNav();
	$(".dropdown-button").dropdown();
	$('.slider').slider({full_width: true,height:650});
	$('.parallax').parallax();
	$('.slider').slider('pause');
	$('.slider').slider('start');

    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 10, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'right' // Displays dropdown with edge aligned to the left of button
    });
});


