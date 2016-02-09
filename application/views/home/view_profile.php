<div class="container-fluid margin-top-5">
	<div class="col-lg-3">
	<h3><center><b><?=$profile[0]['name']?></b></center></h3>
	<b><center><h4><?=$profile[0]['city']?> , <?=$profile[0]['state']?> , <?=$profile[0]['country']?></h4></center></b>
	<img src="<?=site_url()?>uploads/<?=$profile[0]['image']?>" class="img-thumbnail img-circle" height=500 width=500 />
	<div id="request_btn_area">
	<?php
	if($choice == 1 || $choice == 4)
	{
	?>
	<div class="dropdown">
	  <button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Add Friend 
	  <span class="caret"></span></button>
	  <ul class="dropdown-menu">
	    <li><a href="#" data-pp-id="<?=$profile_id?>" id="add_friend">Send request to <?=$profile[0]['name']?></a></li>
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
	    <li><a href="#" id="cancel_request" data-pp-id="<?=$profile_id?>">Cancel friend request</a></li>
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
	    <li><a href="#" data-pp-id="<?=$profile_id?>" id="un_friend">Unfriend <?=$profile[0]['name']?></a></li>
	  </ul>
	</div>
	<?php
	}else if($choice == 6){

	}
	?>
	</div>
	</div>
	<div class="col-lg-9">
		<h3 class="tableHeading">Player Profile</h3>
		<table class="table table-bordered  table-striped" >

		<thead class="success">
		<tr>
		<th>Batting Style</th>
		<th>Bowling Style</th>
		<th>Total Runs</th>
		<th>Number of Fours</th>
		<th>Number of Sixers</th>
		<th>Total Wickets</th>
		</tr>
		</thead>
		<tr>
		<td><?=$profile[0]['BattingStyle']?></td>
		<td><?=$profile[0]['BowlingStyle']?></td>
		<td><?=$six_four[0]['runs']?></td>
		<td><?=$six_four[0]['fours']?></td>
		<td><?=$six_four[0]['sixes']?></td>		
		<td><?=$wicket[0]['wickets']?></td>
		</tr>

		</table>

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
</div>

<?php
if($choice !== 0){
?>
<div id="pop" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Conformation!</h4>
      </div>
      <div class="modal-body" id="pop-message">
        <?=$btn?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
}
?>
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
						$('#request_btn_area').html('<div class="dropdown"><button class="btn btn-info btn-block dropdown-toggle" type="button" data-toggle="dropdown"> Friends <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="#" data-pp-id="<?=$profile_id?>" id="un_friend">Unfriend</a></li></ul></div>');
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
						sweetAlert("",data.message, "success");
					}else{
						sweetAlert("Oops...!",data.message, "error");
						$(this).removeAttr('disabled');
					}
			});
			e.preventDefault();
		});

	});
</script>