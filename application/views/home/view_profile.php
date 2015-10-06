<div class="container-fluid margin-top-5">
	<div class="col-lg-3">
	<b><center><?=$name[0]['fullname']?></center></b>
	<b><center><?=$location[0]['state']?> , <?=$location[0]['city']?></center></b>
	<img src="<?=site_url()?><?=$profile_pic?>" class="img-thumbnail img-circle" height=500 width=500 />
	<?php
	if($this->session->userdata('logged_in') !== FALSE && $this->session->userdata('user_id') !== $user_id){
	?>
	<button class="btn btn-block btn-default" data-pp-id="<?=$profile_id?>" data-user-id="<?=$user_id?>" id="add_friend"> Add Friend </button>
	<?php
	}
	?>
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
		<td><?=$style[0]['bat']?></td>
		<td><?=$style[0]['bow']?></td>
		<td><?=$runs[0]['runs']?></td>
		<td><?=$four[0]['fours']?></td>
		<td><?=$six[0]['sixes']?></td>		
		<td><?=$wickets[0]['wikets']?></td>
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
		<td><?=$row['OpponentTeam']?></td>
		<td><?=$row['Overs']?></td>
		<td><?=$row['RunsGiven']?></td>
		<td><?=$row['MatchDate']?></td>
		</tr>
		<?php
		}
		?>

		</table>

</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#add_friend').click(function(){
			alert(1);
		});
	});
</script>