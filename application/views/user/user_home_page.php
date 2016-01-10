<div class="container margin-top-5">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-md-3-offset text-center">
                        <img src="<?=site_url()?>uploads/<?=$profile_detail[0]['image']?>" name="aboutme" width="200" height="200" class="img-circle img-thumbnail">
                    </div>
                    <div class="col-sm-6 col-md-8 text-center">
                        <h4><?=$profile_detail[0]['name']?></h4>
                        <small><cite title="<?=$profile_detail[0]['country']?>"><?=$profile_detail[0]['city']?>,<?=$profile_detail[0]['state']?>,<?=$profile_detail[0]['country']?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p>
                            Batting style: <b><?=$profile_detail[0]['BattingStyle']?></b><br />
                            Bowling style: <b><?=$profile_detail[0]['BowlingStyle']?></b><br />
                            TOTAL RUNS : <?=$profile_detail[0]['total_runs']?><br />
                            TOTAL FOURS : <?=$profile_detail[0]['fours']?><br />
                            TOTAL SIXES : <?=$profile_detail[0]['sixes']?><br />
                            DATE OF BIRTH : <?=date('d M Y',strtotime($profile_detail[0]['DOB']))?></p>
                        <!-- Split button -->
                        <?php
					if($choice == 1 || $choice == 4){
					?>
					<div class="dropdown">
					  <button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Add Friend 
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
					    <li><a href="#" data-pp-id="<?=$profile_id?>" id="add_friend">Send request</a></li>
					  </ul>
					</div>
					<?php
					}
					else if($choice == 2)
					{
					?>
					<div class="dropdown">
					  <button class="btn btn-info btn-block dropdown-toggle" data-pp-id="<?=$profile_id?>" data-user-id="<?=$user_id?>" type="button" data-toggle="dropdown"> Request Sent
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
					    <li><a href="#" id="cancel_request" data-pp-id="<?=$profile_id?>">Cancel request</a></li>
					  </ul>
					</div>
					<?php
					}
					else if($choice == 3)
					{
					?>

					<button class="btn btn-info dropdown-toggle" data-pp-id="<?=$profile_id?>" data-user-id="<?=$user_id?>" type="button" data-toggle="dropdown" id="accept_request"> Conform Request </button>
					<button class="btn btn-danger dropdown-toggle" data-pp-id="<?=$profile_id?>" data-user-id="<?=$user_id?>" type="button" data-toggle="dropdown" id="cancel_request"> Cancel Request </button>
					<?php
					}
					else if($choice == 5){
					?>
					<div class="dropdown">
					  <button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Friends 
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
					    <li><a href="#" data-pp-id="<?=$profile_id?>" id="un_friend">Unfriend</a></li>
					  </ul>
					</div>
					<?php
					}else if($choice == 6){

					}
					?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container margin-top-5">
	<div class="col-md-6">
        <h3 class="tableHeading">Bowling History</h3>
		<table class="table table-bordered table-striped" >
		<thead class="success">
		<tr>
		<th>Played For</th>
		<th>Overs Bowled</th>
		<th>Wickets Taken</th>
		<th>Runs Given</th>
		<th>Played Against</th>
		<th>Match Overs</th>
		<th>Match Date</th>

		</tr>
		</thead>
		
		<?php
		foreach ($bowling_history as $row) {
		?>
		<tr>
		<td><?=$row['MyTeamName']?></td>
		<td><?=$row['OversBowled']?></td>
		<td><?=$row['Wickets']?></td>
		<td><?=$row['RunsGiven']?></td>
		<td><?=$row['OpponentTeam']?></td>
		<td><?=$row['Overs']?></td>
		<td><?=$row['MatchDate']?></td>
		</tr>
		<?php
		}
		?>

		</table>
    </div>
    <div class="col-md-6">
    	<h3 class="tableHeading">Batting History</h3>

		<table class="table table-bordered table-striped" >
		<thead class="success">
		<tr>
		<th>Played For</th>
		<th>Balls Faced</th>
		<th>Runs Scored</th>
		<th>Fours</th>
		<th>Sixers</th>
		<th>Played Against</th>
		<th>Match Overs</th>
		<th>Match Date</th>

		</tr>
		</thead>
		
		<?php
		foreach ($batting_history as $row) {
		?>
		<tr>
		<td><?=$row['MyTeamName']?></td>
		<td><?=$row['BallsFaced']?></td>
		<td><?=$row['RunsScored']?></td>
		<td><?=$row['Four']?></td>
		<td><?=$row['Six']?></td>
		<td><?=$row['OpponentTeam']?></td>
		<td><?=$row['Overs']?></td>
		<td><?=$row['MatchDate']?></td>
		</tr>
		<?php
		}
		?>

		</table>
    </div>
</div>
<style type="text/css">
body{padding-top:30px;}

.glyphicon {  margin-bottom: 10px;margin-right: 10px;}

small {
display: block;
line-height: 1.428571429;
color: #999;
font-size: 13px;
}
p{
	font-size: 15px;
}
</style>

<script type="text/javascript">
	$(function(){
		$(document).on('click', '#add_friend', function(e) {
			$(this).attr('disabled','true');
			$.post("<?=site_url()?>social/request",{"to":$(this).data('pp-id'),"type":0,"status":0},
				function(data){
					if(data.success == 1){
						$('#request_btn_area').html('<div class="dropdown"><button class="btn btn-info btn-block dropdown-toggle" data-pp-id="<?=$profile_id?>" data-user-id="<?=$user_id?>" type="button" data-toggle="dropdown"> Request Sent <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" id="cancel_request" data-pp-id="'+data.opt+'" >Cancel request</a></li></ul></div>');
						sweetAlert("",data.message, "success");
					}else{
						sweetAlert("Oops...!",data.message, "error");
						$(this).removeAttr('disabled');
					}
				});
			e.preventDefault();
		});

		$(document).on('click', '#cancel_request', function(e){
			$(this).attr('disabled','true');
			$.post("<?=site_url()?>social/request",{"to":$(this).data('pp-id'),"type":0,"status":4},
				function(data){
					if(data.success == 1){
						$('#request_btn_area').html('<div class="dropdown"><button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Add Friend <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" data-pp-id="<?=$profile_id?>" id="add_friend">Send request</a></li></ul></div>');
						sweetAlert("",data.message, "success");
					}else{
						sweetAlert("Oops...!",data.message, "error");
						$(this).removeAttr('disabled');
					}
			});
			e.preventDefault();
		});

		$(document).on('click', '#accept_request', function(e){
			$(this).attr('disabled','true');
			$.post("<?=site_url()?>social/request",{"to":$(this).data('pp-id'),"type":0,"status":1},
				function(data){
					if(data.success == 1){
						$('#request_btn_area').html('<div class="dropdown"><button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Friends <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" data-pp-id="<?=$profile_id?>" id="add_friend">Unfriend</a></li></ul></div>');
						sweetAlert("",data.message, "success");
					}else{
						sweetAlert("Oops...!",data.message, "error");
						$(this).removeAttr('disabled');
					}
			});
			e.preventDefault();
		});

		$(document).on('click', '#un_friend', function(e){
			$(this).attr('disabled','true');
			$.post("<?=site_url()?>social/request",{"to":$(this).data('pp-id'),"type":0,"status":5},
				function(data){
					if(data.success == 1){
						$('#request_btn_area').html('<div class="dropdown"><button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Add Friend <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" data-pp-id="<?=$profile_id?>" id="add_friend">Send request</a></li></ul></div>');
						sweetAlert(data.message);
					}else{
						sweetAlert("Oops...!",data.message, "error");
						$(this).removeAttr('disabled');
					}
			});
			e.preventDefault();
		});

	});
</script>