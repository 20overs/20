<div class="container-fluid margin-top-5">
	<div class="row">
			<div class="col-lg-4 col-md-4 height-400">
				<div class="border  padding-9 clearfix article">
					<h4 class="heading">
						LATEST ARTICLES
					</h4>
				<div class="height-300">
					<?php 
					$arti_count = count($arti[0]);
					if ($arti_count > 0): ?>
					<marquee direction="up" id="test" onmouseover="this.stop();" onmouseout="this.start();"  scrollamount="2" style="margin-top:0px;height:350px;">
						<ul class="no-style arti-ul margin-top-5" style="margin-top:-20px;">
						<?php foreach ($arti as $res): ?>
							<li>
								<div class="media">
									<div class="media-body">
										<b><i class="fa fa-user fa-2x"></i> <span class="arti-title blue-font bold font-open"><?=$res['user_name']?> Says:</span></b>
										<p><i class="fa fa-commenting-o"></i> <span class="arti-content font-source"> <?=$res['article']?></span></p>
										<?php
										if($res['external_link'] != ""){
										?>
										<p><a href="<?=$res['external_link']?>" class="label label-success" target="_blank">Click here</a> to visit website</p>
										<?php
										}
										?>
										-<?=$res['match_id']?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
						</ul>
					</marquee>
					<?php else: ?>
							<span class="list-group-item text-center">No Articles Found<span>
					<?php endif; ?>
				</div>
					<span class="padding-9"></span>
					<a class="gold-font font-source" href="<?=site_url('user/articles')?>">
					<i class="fa fa-plus"></i> Create new</a>
				</span>
			</div>
		</div>

		<div class="col-lg-5 col-md-5 img-container  hidden-sm  hidden-xs wow fadeIn" data-wow-duration="3s">
			<div class="banner"></div>
				<?php
				  $min=2;
				  $max=36;
				  $randval =  rand($min,$max);
				?>
				<img src="<?=site_url()?>public/img/front/front<?=$randval?>.jpg" width=100% class="image" />
		</div>
	<div class="col-lg-3 col-md-3">
		<!--<div class="border padding-9 clearfix">
			<h4 class="heading">
				MATCHES TODAY
			</h4>
			<ul class="no-style match-today-ul">
				<li>
					<div class="media">
					<div class="media-body">
					<?php
					if(count($match_today) > 0){
					foreach ($match_today as $row) {
					?>
					<span class="font-source font-size-16"><?=$row['Team1Name']?> vs <?=$row['Team2Name']?></span>
					<small><?=$row['MatchTimeGMT']?> | <?=$row['MatchTimeLocal']?> (IST) | <?=$row['MatchVenue']?></small>
					<?php
					}
					}else{
					?>
					<h3>No matches found</h3>
					<?php
					}
					?>
					<span class="font-source font-size-16">Pakistan vs Zimbabwe</span>
					<small>09:00:00 | 14:00:00 (IST) | Gaddafi Stadium, Lahore</small>
					</div>
					</div>
				</li>
			</ul>
		</div>-->
		<div class="border padding-9 height-400" style="overflow:scroll;">
			<h4 class="heading">
				LIVE SCORE
			</h4>
			<div style="margin-top:0px;height:200px;overflow:auto;">
				<div class="live-score-iframe">
					<script src="//www.cricruns.com/system/application/views/widgetBase/wid_300_200_2_wo_ad.js" type="text/javascript" id="cricruns"></script>
				</div>
			</div>
				<h3>OTHER MATCHES</h3>
				<?=$rss?>
		</div>
	</div>
</div>
<!-- Row one starting -->
<div class="row margin-top-5">
			<div class="col-lg-6">
				<div class="border padding-9 clearfix wow fadeInLeft" data-wow-delay="2s">
					<h4 class="heading">
						SEARCH TALENT
					</h4>
					<div class="col-lg-6">
					<form id='searchtalent' action="<?=site_url()?>search" method="post">
					<div class="form-group">
					 <label class="form-label-cust" for="name">Batting / Bowling style:</label>
					    <select id="bowlbatstyle" name="bowlbatstyle" class="form-control form-control-cust" required>
					    <option value="">Select Batting / Bowling style</option>
						<option value="Left Handed Batting">Left Handed Batting</option>
						<option value="Right Handed Batting">Right Handed Batting</option>
						<option value="Right Arm Fast">Right Arm Fast</option>
						<option value="Right Arm Fast Medium">Right Arm Fast Medium</option>
						<option value="Right Arm Medium">Right Arm Medium</option>
						<option value="Right Arm Medium Fast">Right Arm Medium Fast</option>
						<option value="Left Arm Fast">Left Arm Fast</option>
						<option value="Left Arm Fast Medium">Left Arm Fast Medium</option>
						<option value="Left Arm Medium">Left Arm Medium</option>
						<option value="Left Arm Medium Fast">Left Arm Medium Fast</option>
						<option value="Off Break">Off Break</option>
						<option value="Leg Break">Leg Break</option>
						<option value="Leg Break Googly">Leg Break Googly</option>
						<option value="Slow Left Arm Orthodox">Slow Left Arm Orthodox</option>
						</select>
					</div>

					    <div class="form-group">
							<label class="form-label-cust" for="inputEmail">Country :</label>
					        <select class="form-control form-control-cust" id="country" name="country">
							<option value="">Select Country</option>
							<?php
			                    foreach ($countries as $count) {
			                    ?>
			                    	<option value="<?=$count['countryid']?>"><?=$count['country']?></option>
			                    <?php
			                    }
			                    ?>
							</select>
					    </div>
						
					    <div class="form-group" style="margin-bottom:13px;">
					        <label class="form-label-cust" for="inputPassword">State :</label>
					        <select class="form-control form-control-cust" id="state" name="state">
							<option value="">Select state</option>
							</select>
					    </div>
				</div>
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="form-label-cust" for="city">City :</label>
				        <select class="form-control form-control-cust" id="city" name="city">
						<option value="">Select city</option>
						</select>
				    </div>
					
				    <div class="form-group">
				        <label class="form-label-cust" for="inputPassword">Zipcode :</label>
				        <input type="text" class="form-control  form-control-cust" id="zipcode" name="zipcode" placeholder="Zipcode">
				    </div>

				<input type="submit" class="btn search-btn"  value="Search" />
				</form>
				</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="border padding-9">
					<h4 class="heading">
						TALENTS TODAY
					</h4>
					<div class="margin-left-3">
						<span class="talent-today-name">
						<?php
							foreach ($talent as $row):
						?>
							<a href='<?=site_url()?>user/view_profile/<?=$row['id']?>' class="user"><i class="fa fa-user fa-lg"></i> <?=$row['fullname']?></a>
						</span>
					</div>
							<ul class="no-style talent-ul">
								<li>
									<h5><i class="fa fa-newspaper-o"></i> <?=$row['age']?> Yrs</h5>
								</li>
								<li>
									<h5><i class="fa fa-newspaper-o"></i> <?=$row['BattingStyle']?></h5>
								</li>
								<li>
									<h5><i class="fa fa-newspaper-o"></i> <?=$row['BowlingStyle']?></h5>
								</li>
								<li>
									<h5><i class="fa fa-newspaper-o"></i> <?=$row['city_name']?> , <?=$row['Country']?></h5>
								</li>
							</ul>
						<?php
							endforeach;
						?>
					</div>

			</div>
			<div class="col-lg-3">
				<div class="border padding-9">
			        <h4 class="heading">
			        	RECENT USERS
			        </h4>
					<ul class="no-style recent-ul">
						<?php
						foreach ($recent_users as $row):
						?>
							<li>
								<h5><i class="fa fa-user-plus"></i> <?=ucwords($row['name'])?></h5>
							</li>
						<?php
						endforeach;
						?>
					</ul>
				</div>
			</div>
</div>

<!-- Row 2 starts -->

	<div class="row margin-top-5 rows3">
		<div class="col-lg-3">
			<div class="border padding-9">
				<h4 class="heading">
					TRENDING NOW
				</h4>
				<ul class="no-style trending-ul" id="trending">
					
				</ul>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="border  padding-9">
				<h4 class="heading">
					GET TO KNOW
				</h4>
				<ul class="no-style trending-ul" id="what_is">
				</ul>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="border padding-12">
				<h4 class="heading">
					GOOGLY
				</h4>
				<center><i class="fa fa-question-circle fa-5x"></i></center>
				<div class="googly">
					<p>
						<i class="fa fa-mail-forward icon-top"></i><span class="font-source" id="question"></span>
					</p>
					<center>
						<h3 class="bolder">
							<span class="font-source" id="ans"></span>
						</h3>
					</center>
				</div>
			</div>
		</div>

		<div class="col-lg-3 wow fadeInRight" data-wow-delay="1s">
			<div class="border  padding-9">
			   <h4 class="heading">
				EXTRAS
			   </h4>
				<ul class="no-style trending-ul" id="extras">
				</ul>
			</div>
		</div>
	</div>

</div>


<script type="text/javascript">
	$(function(){
		$('#what_is,#trending,#extras').html('<center><i class="fa fa-refresh fa-spin fa-2x"></i></center>');
		setInterval(function(){
		$.get("<?=site_url()?>welcome/get_trending_now",function(data){
			var list='';
			$.each(data,function(key,val){
				list += '<li><i class="fa fa-mail-forward"></i> <span class="font-source">'+data[key].News+'</span></li>';
			});
			$('#trending').html(list);
		});
		$.get("<?=site_url()?>welcome/get_extras",function(data){
			var list='';
			$.each(data,function(key,val){
				list += '<li><i class="fa fa-mail-forward"></i> <span class="font-source">'+data[key].News+'</span></li>';
			});
			$('#extras').html(list);
		});
		$.get("<?=site_url()?>welcome/get_what_is",function(data){
			var list='';
			$.each(data,function(key,val){
				list += '<li><i class="fa fa-mail-forward "></i> <span class="font-source">'+data[key].News+'</span></li>';
			});
			$('#what_is').html(list);
		});
	}, 3500);

		$.get("<?=site_url()?>welcome/get_googly",function(data){
			$.each(data,function(key,val){
				$('#question').html(data[0].question);
				$('#ans').html(data[0].ans);
			});
		});

	$(document).on('change', "#country", function(){
	    var country_id = $(this).val();
	    $.post('<?=site_url()?>welcome/get_states',{country_id:country_id},function(data){
	    	var list='<option value="">Select state</option>';
	    	$.each(data,function(key,val){
				list += '<option value="'+data[key].stateid+'">'+data[key].name+'</option>';
			});
			$('#state').html(list);
	    });
	    return false;
	});

	$(document).on('change', "#state", function(){
		var country_id = $('#country').val();
	    var state_id = $(this).val();
	    $.post('<?=site_url()?>welcome/get_cities',{state_id:state_id,country_id:country_id},function(data){
	    	console.log(data);
	    	var list='<option value="">Select state</option>';
	    	$.each(data,function(key,val){
				list += '<option value="'+data[key].id+'">'+data[key].city_name+'</option>';
			});
			$('#city').html(list);
	    });
	    return false;
	});

	});

	
</script>