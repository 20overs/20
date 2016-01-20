<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-lg-4 col-md-4">
			<div class="panel-group">
				<div class="panel panel-info">
				    <div class="panel-heading">
				    	<center><span class="h4 handover">FRIENDS REQUESTS</span></center>
				    </div>
				    <div class="panel-body">
				    	<ul class="list-group">
				    		<li class="list-group-item"><b>FRIENDS REQUESTS</b><span class="badge"><?=count($friend_req)?></li>
				    		<?php
				    		if($friend_req != FALSE)
				    		{
				    		foreach ($friend_req as $row)
				    		{
				    		?>
				    		<li class="list-group-item">
				    			<a href="<?=site_url()?>welcome/view_profile/<?=$row['Id']+674539873?>"><?=$row['Name']?></a>
				    			<button class="btn btn-danger btn-xs pull-right reject" data-pp-id="<?=$row['Id']+674539873?>"><i class="fa fa-times" style="color:#fff;"></i></button> 
				    			<button class="btn btn-success btn-xs pull-right accept" data-pp-id="<?=$row['Id']+674539873?>"><i class="fa fa-check" style="color:#fff;"></i></button>
				    		</li>
				    		<?php
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

		<div class="col-lg-4 col-md-4">

			<div class="panel-group">
				<div class="panel panel-info">
				    <div class="panel-heading">
				    	<center><span class="h4 handover">FRIENDS LIST</span></span></center>
				    </div>
				    <div class="panel-body">
				    	<ul class="list-group">
				    		<li class="list-group-item"><b class="h4">TOTAL FRIENDS</b><span class="badge"><?=count($friend_list)?></li>
				    		<?php
				    		if($friend_list != FALSE)
				    		{
				    		foreach ($friend_list as $row)
				    		{
				    		?>
				    		<li class="list-group-item">
				    			<a href="<?=site_url()?>welcome/view_profile/<?=$row['Id']+674539873?>">
				    				<i class="fa fa-check"></i> <?=$row['Name']?>
				    			</a>
				    		</li>
				    		<?php
				    		}
				    		}
				    		else
				    		{
				    		?>
				    		<li class="list-group-item">NO FRIENDS FOUND</li>
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
	$('.accept').click(function(){
		$(this).parent().slideUp(1000);
		$.post("<?=site_url()?>social/request",{"to":$(this).data('pp-id'),"type":0,"status":1},
			function(data){
				if(data.success == 1){
					//sweetAlert("",data.message, "success");
					$(this).parent().fadeOut(1000);
					location.reload();
				}else{
					sweetAlert("Oops...!",data.message, "error");
					$(this).removeAttr('disabled');
					$(this).parent().slideDown(1000);
				}
		});
	});
	$('.reject').click(function(){
		$(this).attr('disabled','true');
		$.post("<?=site_url()?>social/request",{"to":$(this).data('pp-id'),"type":0,"status":4},
			function(data){
				if(data.success == 1){
					//sweetAlert("",data.message, "success");
					location.reload();
				}else{
					sweetAlert("Oops...!",data.message, "error");
					$(this).parent().slideDown(1000);
				}
		});
	});
</script>