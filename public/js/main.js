$(document).ready(function(){


$('.banner').hover(function(){
	$('.image').toggleClass('anim');
});

$('html,body').scroll(function(){
  $(this).animate({
    scrollTop: $("#cont").offset().top
  });
});
/*
$("#go").click(function() {
    $('html, body').animate({
        scrollTop: $("#cont").offset().top
    }, 1000);
});


$("#logout").click(function(e){
    $.post("user/logout",{logout:1},function(){
      window.open("/",'_self');
    });
    e.preventDefault();
  });
*/

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
    $.post('get_states/',{id:id},function(data){
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
    $.post('get_cities/',{country:$('#country').val(),state:$(this).val()},function(data){
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

  $('#create_profile').submit(function(e){
    $.ajax({
      url:'create_profile',
      data:$(this).serializeArray(),
      method:"POST",
      success :function(data){
        data = jQuery.parseJSON(data);
        $('#result').html("<h3 class='text-success'>Your Profile id is <b>"+data.message+"</b>.If you want to make any change in your profile this profile id is required.</h3>");
      },
      error: function(){
        $('#result').html("<h3 class='text-danger'>Player profile already created.</h3>");
      }
    });
    e.preventDefault();
  });

  $('#update_profile').submit(function(e){
    $.ajax({
      url:'update_profile',
      data:$(this).serializeArray(),
      method:"POST",
      success :function(data){
        data = jQuery.parseJSON(data);
        $('#result').html("<h3 class='text-success'>"+data.message+"</h3>");
      },
      error: function(){
        $('#result').html("<h3 class='text-danger'>Error updating player profile.</h3>");
      }
    });
    e.preventDefault();
  });

  

  $('div[data-toggle="collapse"]').click(function(){
    if($('.collapse').hasClass('in')){
      $('.collapse').removeClass('in');
    }else{
      $('.collapse').addClass('in');
    }
  });

  $('#batting_history').submit(function(e){
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
   e.preventDefault();
  });

  $('#bowling_history').submit(function(e){
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
   e.preventDefault();
  });

  $('.delete_batting').click(function(){
    $(this).parent().fadeOut(800);
    $.ajax({
      url:'del_batting',
      data:{id:$(this).attr('data-id')},
      method:"POST",
      success :function(data){
        data = jQuery.parseJSON(data);
          alert(data.message);
      },
      error: function(){
        alert("Server error try again later");
        $(this).parent().fadeIn(500);
      }
    });
  });

  $('.delete_bowling').click(function(){
    $(this).parent().fadeOut(800);
    $.ajax({
      url:'del_bowling',
      data:{id:$(this).attr('data-id')},
      method:"POST",
      success :function(data){
        data = jQuery.parseJSON(data);
          alert(data.message);
      },
      error: function(){
        alert("Server error try again later");
        $(this).parent().fadeIn(500);
      }
    });
  });

  //A

  $('#matchid').change(function(){
  if($(this).val() != 0 ){
    $('#arti,#countdown').slideDown(300);
    $('#ajax').text('');
    }else{
    $('#arti,#countdown').slideUp(300);
    $('#arti_submit').slideUp(300);
    }
  });
  
  $('#arti').keyup(function(e){
  if($(this).val().length!=0){
  $('#arti_submit').slideDown(300);
  var output = $(this).val();
  $('#op').text(output);
  var arti = $('#op').text();
  var remaining = 250 - arti.length;
  $('#countdown').text(remaining+' characters remaining.');
  arti = arti.replace(/(\r\n|\n|\r)/gm," ");
  arti = arti.replace(/\s+/g," ");
    badwords = /\b(fuck|suck|dick|fucks|piss|pussy|sunni|punda|otha|ootha|fucker|Fuck|Suck|Pussy|Sunni|Punda|Ootha|Fuckoff|fuckoff)\b/g;
    output = output.replace(badwords, function (fullmatch, badword) {
        return new Array(badword.length + 1).join('*');
    });
    if($(this).val().length >= 250){
      $(this).addClass('has-err');
    }else{
      $(this).removeClass('has-err');
    }
    $('#op').text(output);
    }else{
      $('#arti_submit').slideUp(300);
    }
  });
  
  $('#arti_form').submit(function(e){
  //$('#ajax').html("<img src='http://20overs.com/_img/fb_load.gif' />");
  var arti = $('#op').text();
  arti = arti.replace(/(\r\n|\n|\r)/gm," ");
    arti = arti.replace(/\s+/g," ");
  if(arti.length ==0){
    $('#ajax').html("<div class='badge badge-error'>Enter Some Data To Post Article</div>");
  }else{
    $.post('add_articles',{id:$('#matchid').val(),name:$('#name').val(),arti:arti},function(data){
    $('#arti').val();
      $('#ajax').html("<div class='badge badge-success'>"+data+"</div>");
      $('#arti').val('');$('#matchid').val('0');$('#op').text('');
      $('#arti_submit').css('display','none');
      $('#arti').css('display','none');
      $('#countdown').text('250 characters remaining.');
      $('#countdown').css('display','none');
    });
    }
    e.preventDefault(); 
  });

  $('#recover_mail').submit(function(e){
    $.post("send_email/",$(this).serializeArray(),function(data){
      $('#recover_email_res').html("<h4>"+data+"</h4>");
      $(this).reset();
    });
    e.preventDefault();
  });

});