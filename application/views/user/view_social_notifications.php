<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-md-4">
			<div class="panel-group">
				<div class="panel panel-info">
				    <div class="panel-heading">
				    	<center><span class="h4 handover">NOTIFICATIONS</span></center>
				    </div>
				    <div class="panel-body">
				    	<ul class="list-group">
				    		<?php
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
				    		}
				    		}
				    		else
				    		{
				    		?>
				    		<li class="list-group-item">NO FRIEND REQUESTS FOUND</li>
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
</script>