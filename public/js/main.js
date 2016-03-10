$(document).ready(function(){

  $('[data-toggle="tooltip"]').tooltip();
  $('.open_new').click(function(e){
    window.open($(this).attr('href'), '_blank');
    e.preventDefault();
  });
  $('.banner').hover(function(){
  	$('.image').toggleClass('anim');
  });

  $('html,body').scroll(function(){
    $(this).animate({
      scrollTop: $("#cont").offset().top
    });
  });

 $('#flipper').click(function(){
 if($(this).text().trim() == "New User Please Register"){
 $(this).text('Existing User Login Here');
 $('#myModalLabel').text('Sign up Now');
 }else{
 $(this).text("New User Please Register");
 $('#myModalLabel').text('Login to Your Account');
 }
 $('#login-modal').toggleClass('flip');
 $('#reg-flip,#login-flip').toggleClass('hide');
 });
 
 
  $("html").removeAttr("class");
  
  $('#country').change(function(e){
    var id = $(this).val();
    var opt="<option value=''>Select state</option>";
    $.post('user/get_states/',{id:id},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.stateid+"'>"+value.name+"</option>";
        });
        $('#state').html(opt);
        $('#city').html("<option value=''>Select city</option>");
    });
    e.preventDefault();
  });

  $('#state').change(function(){
    var opt="<option value=''>Select city</option>";
    $.post('user/get_cities/',{country:$('#country').val(),state:$(this).val()},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.id+"'>"+value.city_name+"</option>";
        });
        $('#city').html(opt);
    });
  });

  $('#bowling_type').change(function(){
    var opt="<option value=''>Select bowling style</option>";
    $.post('bowling_style/',{id:$(this).val()},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.id+"'>"+value.name+"</option>";
        });
        $('#bowling_style').html(opt);
    });
  });

  $(function(){
   $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
  });

  $('div[data-toggle="collapse"]').click(function(){
    if($('.collapse').hasClass('in')){
      $('.collapse').removeClass('in');
    }else{
      $('.collapse').addClass('in');
    }
  });

  $('#batting_history').submit(function(e){
    var val = $('#match_result').val();
    var matches = val.match(/\d+/g);
    if (matches != null) {
        alert('Match result contain numbers please remove it.');
    }else{
      $.ajax({
        url:'batting_history',
        data:$(this).serializeArray(),
        method:"POST",
        success :function(data){
          data = jQuery.parseJSON(data);
          if(data.errors === 0){
            document.getElementById("batting_history").reset();
            $('#bat_result').html("<span class='h3 text-success'>"+data.message+"</span>");
          }else{
            $('#bat_result').html("<span class='h3 text-danger'>"+data.message+"</span>");
          }
        },
        error: function(){
          $('#bat_result').html("<span class='h3 text-danger'>Server error try again later</span>");
        }
      });
    }
     e.preventDefault();
  });

  $('#bowling_history').submit(function(e){
    var val = $('#match_result1').val();
    var matches = val.match(/\d+/g);
    if (matches != null) {
        alert('Match result contain numbers please remove it.');
    }else{
    $.ajax({
      url:'bowling_history',
      data:$(this).serializeArray(),
      method:"POST",
      success :function(data){
        data = jQuery.parseJSON(data);
        if(data.errors === 0){
          document.getElementById("bowling_history").reset();
          $('#bow_result').html("<span class='h3 text-success'>"+data.message+"</span>");
        }else{
          $('#bow_result').html("<span class='h3 text-danger'>"+data.message+"</span>");
        }
      },
      error: function(){
        $('#bow_result').html("<span class='h3 text-danger'>Server error try again later</span>");
      }
    });
  }
   e.preventDefault();
  });

  $('#matchid').change(function(){
  if($(this).val() != 0 ){
    $('#arti,#countdown,#link').slideDown(300);
    $('#ajax').text('');
    }else{
    $('#arti,#countdown,#link').slideUp(300);
    $('#arti_submit').slideUp(300);
    }
  });
  
  

  $('#recover_mail').submit(function(e){
    $('#recover_mail_submit').attr('disabled','true');
    $.post("send_email/",$(this).serializeArray(),function(data){
      $('#recover_email_res').html("<h4>"+data+"</h4>");
      document.getElementById("recover_mail").reset();
      $('#recover_mail_submit').removeAttr('disabled');
    });
    e.preventDefault();
  });

});