<div class="container-fluid margin-top-5">
	<div class="row">
			<div class="col-lg-4 col-md-4 height-400">
				<div class="border  padding-9 clearfix article">
					<h4 class="heading">
						LATEST ARTICLES
					</h4>
				<div class="height-300">
					<?php if ($arti_count > 0): ?>
					<marquee direction="up" id="test" onmouseover="this.stop();" onmouseout="this.start();"  scrollamount="2" style="margin-top:0px;height:350px;">
						<ul class="no-style arti-ul margin-top-5" style="margin-top:-20px;">
						<?php foreach ($arti as $res): ?>
							<li>
								<div class="media">
									<div class="media-body">
										<b><img src="<?=site_url()?>public/img/icons/user.png" class="icon-top"/> <span class="arti-title blue-font bold font-open"><?=$res['user_name']?> Says:</span></b>
										<p><img src="<?=site_url()?>public/img/icons/message.png" class="icon-top"/> <span class="arti-content font-source"> <?=$res['article']?></span></p>
										<?php
										if($res['external_link'] != ""){
										?>
										<p><a href="<?=$res['external_link']?>" class="label label-success open_new">Click here</a> to visit website</p>
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
					<a class="gold-font font-source" href="<?=site_url('user/articles')?>"><img src="<?=site_url()?>public/img/icons/plus.png" class="icon-top"/> Create new</a>
				</span>
			</div>
		</div>

		<div class="col-lg-5 col-md-5 img-container  hidden-sm  hidden-xs">
			<div class="banner"></div>
				<?php
				  $min=2;
				  $max=36;
				  $randval =  rand($min,$max);
				?>
				<img src="<?=site_url()?>public/img/front/front<?=$randval?>.jpg" width=100% class="image" />
		</div>
	<div class="col-lg-3 col-md-3">
		<div class="border padding-9 clearfix">
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
						<!--
						<span class="font-source font-size-16">Pakistan vs Zimbabwe</span>
						<small>09:00:00 | 14:00:00 (IST) | Gaddafi Stadium, Lahore</small>
						-->
					</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="border  padding-9 margin-top-5">
			<h4 class="heading">
				LIVE SCORE
			</h4>
			<div class="live-score-iframe">
				<script src="//www.cricruns.com/system/application/views/widgetBase/wid_300_200_2_wo_ad.js" type="text/javascript" id="cricruns"></script>
			</div>
		</div>
	</div>
</div>

<!-- Row one starting -->

<div class="row margin-top-5">
			<div class="col-lg-6">
				<div class="border padding-9 clearfix">
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
					        <select class="form-control form-control-cust" id="scountry" name="country">
							<option value="">Select Country</option>
							<?php
			                    foreach ($countries as $count) {
			                    ?>
			                    	<option value="<?=$count['countryid']?>">
			                    		<?=$count['country']?>
			                    	</option>
			                    <?php
			                    }
			                    ?>
							</select>
					    </div>
						
					    <div class="form-group" style="margin-bottom:13px;">
					        <label class="form-label-cust" for="inputPassword">State :</label>
					        <select class="form-control form-control-cust" id="sstate" name="state">
							<option value="">Select state</option>
							</select>
					    </div>
				</div>
				<div class="col-lg-6">
				    <div class="form-group">
				        <label class="form-label-cust" for="inputEmail">City :</label>
				        <select class="form-control form-control-cust" id="scity" name="city">
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

						<img src="<?=site_url()?>public/img/icons/user.png" class="icon-top"/>
						<span class="talent-today-name">
						<?php
							$curryear = date('Y');
							$doby = explode("-",$talent[0]["DOB"]);
							$age = $curryear-$doby[0];
							foreach ($talent as $row):
						?>
							<a href='<?=site_url()?>user/view_profile/<?=$row['Id']+674539873?>' class="user"><?=$row['fullname']?></a>
						</span>
					</div>
							<ul class="no-style talent-ul">
								<li>
									<h5><img src="<?=site_url()?>public/img/icons/trending.png"> <?=$age?> Yrs</h5>
								</li>
								<li>
									<h5><img src="<?=site_url()?>public/img/icons/trending.png"> <?=$row['BattingStyle']?></h5>
								</li>
								<li>
									<h5><img src="<?=site_url()?>public/img/icons/trending.png"> <?=$row['BowlingStyle']?></h5>
								</li>
								<li>
									<h5><img src="<?=site_url()?>public/img/icons/trending.png"> <?=$row['city_name']?> , <?=$row['Country']?></h5>
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
						foreach ($recent as $row):
						?>
							<li>
								<h5><img src="<?=site_url()?>public/img/icons/recent.png" height="25" width="25"> <?=$row['Firstname']?></h5>
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
			<div class="border  padding-9">
				<h4 class="heading">
					TRENDING NOW
				</h4>
				<ul class="no-style trending-ul">
					<?php
						foreach ($trending as $row):
					?>
					<li>
						<img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top"/>
						<span class="font-source"><?=$row['news']?></span>
					</li>
					<?php
						endforeach;
					?>
				</ul>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="border  padding-9">
				<h4 class="heading">
					WHAT IS?
				</h4>
				<ul class="no-style trending-ul">
				<?php
				foreach ($whatis as $row):
				?>
					<li>
						<img src="<?=site_url()?>public/img/icons/trending.png" class="icon-top"/>
						<span class="font-source"><?=$row['news']?></span>
					</li>
				<?php
				endforeach;
				?>
				</ul>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="border padding-12">
				<h4 class="heading">
					GOOGLY
				</h4>
				<center><img src="<?=site_url()?>public/img/icons/quest.png" height="40"/></span></center>
				<div class="googly">
					<?php
					foreach ($quiz as $row):
					?>
						<p>
							<img src="<?=site_url()?>public/img/icons/crossarrow.png" height="17" class="icon-top"/>
							<span class="font-source"><?=$row['qq']?></span>
						</p>
						<center>
							<h3 class="bolder">
								<span class="font-source"><?=$row['qa1']?></span>
							</h3>
						</center>
					<?php
					endforeach;
					?>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="border  padding-9">
			   <h4 class="heading">
				EXTRAS
			   </h4>
			<ul class="no-style trending-ul">
				<?php
				foreach ($extras as $row):
				?>
				<li>
					<img src="<?=site_url()?>public/img/icons/trending.png">
					<span class="font-source"><?=$row['news']?></span>
				</li>
				<?php
				endforeach;
				?>
			</ul>
			</div>
		</div>
	</div>

</div>