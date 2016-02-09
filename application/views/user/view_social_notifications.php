<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-md-4">
			<div class="panel-group">
				<div class="panel panel-info"  style="height:700px;overflow:auto;">
				    <div class="panel-heading">
				    	<center><span class="h4 handover">NEW NOTIFICATIONS</span> <span class="badge pull-right"><?=$notification_count?></span></center>
				    </div>
				    <div class="panel-body">
				    	<ul class="list-group new-noti">
				    		<?php
				    		$last_id = $notification_list[0]['noti_id'];
				    		if($notification_list != FALSE)
				    		{
				    		foreach ($notification_list as $row)
				    		{
				    			if($row['status'] == 'pending' && $row['type'] == 'friend')
				    			{
				    		?>
					    		<li class="list-group-item">
					    			<a href="<?=site_url()?>welcome/view_profile/<?=$row['Id']+674539873?>">You have a <?=$row['type']?> request <?=$row['status']?> from <?=$row['Name']?>.</a>
					    		</li>
				    		<?php
				    			}
				    			else if($row['status'] == 'accepted' && $row['type'] == 'friend')
				    			{
				    		?>
					    		<li class="list-group-item">
					    			<a href="<?=site_url()?>welcome/view_profile/<?=$row['Id']+674539873?>"><?=$row['Name']?> accepted your friend request.</a>
					    		</li>
				    		<?php
				    			}
				    			$first_id = $row['noti_id'];
				    		}
				    		}
				    		else
				    		{
				    		?>
				    		<li class="list-group-item">NO NEW NOTIFICATIONS FOUND</li>
				    		<?php
				    		}
				    		?>
				    	</ul>
				    </div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="panel-group">
				<div class="panel panel-info"  style="height:700px;overflow:auto;">
				    <div class="panel-heading">
				    	<center><span class="h4 handover">OLD NOTIFICATIONS</span></center>
				    </div>
				    <div class="panel-body">
				    	<ul class="list-group">
				    		<?php
				    		if($old_notification_list != FALSE)
				    		{
				    		foreach ($old_notification_list as $row)
				    		{
				    			if($row['status'] == 'pending' && $row['type'] == 'friend')
				    			{
				    		?>
					    		<li class="list-group-item">
					    			<a href="<?=site_url()?>welcome/view_profile/<?=$row['Id']+674539873?>">You have a <?=$row['type']?> request <?=$row['status']?> from <?=$row['Name']?>.</a>
					    		</li>
				    		<?php
				    			}
				    			else if($row['status'] == 'accepted' && $row['type'] == 'friend')
				    			{
				    		?>
					    		<li class="list-group-item">
					    			<a href="<?=site_url()?>welcome/view_profile/<?=$row['Id']+674539873?>"><?=$row['Name']?> accepted your friend request.</a>
					    		</li>
				    		<?php
				    			}
				    		}
				    		}
				    		else
				    		{
				    		?>
				    		<li class="list-group-item">NO NEW NOTIFICATIONS FOUND</li>
				    		<?php
				    		}
				    		?>
				    	</ul>
				    </div>
				</div>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.get('<?=site_url()?>social/get_notification/<?=$last_id?>',function(data){
			console.log(data);
		});
	});
</script>
<style type="text/css">
	.new-noti li{
		background: #FFF;
	}
	.new-noti li a{
		color:#428bca;
	}
</style>