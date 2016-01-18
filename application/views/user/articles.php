<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<?php
		if($this->session->userdata('logged_in')!==TRUE){
		?>
		<div class="container">
			<div class="alert alert-info text-center"><h1>Login to post article</h1></div>
		</div>
		<?php
		}else{
		?>
		<div class="col-lg-8 col-md-8">
			<div class="panel-group" id="accordion">
					  <div class="panel panel-info">
					    <div class="panel-heading">
					        <center><span class="h4">Post Articles</span></center>
					    </div>
					      <div class="panel-body">
						      <div class="col-lg-12">
						      <form method="post" id="arti_form">
						      	<div class="form-group">
									<label for="name">Your Name</label>
									<input type="text" id="name" name="name" value="<?=$this->session->userdata('name')?>" class="form-control form-control-cust" disabled>
								</div>
								<div class="form-group">
								  <label for="name">Select Title</label>
								  <select class="form-control form-control-cust" id="matchid">
									<option value="0">Select a Topic</option>
									<?php
								 	if(count($articles) > 0){
									foreach ($articles as $row) {
									?>
										<option value="<?=$row["Team1Name"]?> vs <?=$row["Team2Name"]?>"><?=$row["Team1Name"]?> vs <?=$row["Team2Name"]?></option>
									<?php
										}
									}
									?>
									<!--<option value="India">India</option>
									<option value="Sachin">Sachin</option>
									<option value="Dhoni">Dhoni</option>
									<option value="Dravid">Dravid</option>
									<option value="Rohith">Rohith</option>
									<option value="Kholi">Kholi</option>
									<option value="Suresh Raina">Suresh Raina</option>-->
									<?php
								 	if(count($countries) > 0){
									foreach ($countries as $row) {
									?>
										<option value="<?=$row["country"]?>"><?=$row["country"]?></option>
									<?php
										}
									}
									?>
								  </select>
								</div>
								<div class="form-group">
									<textarea id="arti" name="arti" maxlength="250" class="form-control form-control-cust" placeholder="Write Your Article" style="display:none;" required></textarea>
									<?php
									if($this->session->userdata('admin')==1){
									?>
									<input type="url" name="link" class="form-control" placeholder="Article link" id="link" name="link" style="display:none;" />
									<?php
									}
									?>
								</div>
								<div class="badge badge-success" id="countdown" style="display:none;">250 characters remaining.</div>
								<div> &nbsp; </div>
								<input type="submit" name="sub" class="btn btn-primary" id="arti_submit"  style="display:none;" value="Post Article"/>
							</form>
							<br>
							<div id="op"></div>
							<br>
							<div id="ajax"></div>
                          </div>
                          </div>
                       </div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>
<script type="text/javascript">
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
  $('#arti_submit').attr('disabled','true');
  var arti = $('#op').text();
  arti = arti.replace(/(\r\n|\n|\r)/gm," ");
    arti = arti.replace(/\s+/g," ");
  if(arti.length ==0){
    $('#ajax').html("<div class='badge badge-error'>Enter Some Data To Post Article</div>");
    $('#arti_submit').removeAttr('disabled');
  }else{
    $.post('add_articles',{id:$('#matchid').val(),name:$('#name').val(),link:$('#link').val(),arti:arti},function(data){
    $('#arti').val();
      $('#ajax').html("<div class='badge badge-success'>"+data+"</div>");
      $('#arti,#link').val('');$('#matchid').val('0');$('#op').text('');
      $('#arti_submit').css('display','none');
      $('#arti,#link').css('display','none');
      $('#countdown').text('250 characters remaining.');
      $('#countdown').css('display','none');
      $('#arti_submit').removeAttr('disabled');
    });
    }
    e.preventDefault(); 
  });
</script>