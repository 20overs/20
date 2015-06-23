<div class="container-fluid margin-top-5">
	<div class="row">

			<div class="col-lg-4 col-md-4 height-400">
				<div class="border  padding-9 clearfix article">
					<h4 class="heading">
						<span class="glyphicon glyphicon-star"></span> LATEST ARTICLES
					</h4>
				<div class="height-300">
					<?php if ($arti_count > 0): ?>
					<marquee direction="up" id="test" onmouseover="this.stop();" onmouseout="this.start();"  scrollamount="2" style="margin-top:0px;height:350px;">
						<ul class="no-style arti-ul margin-top-5" style="margin-top:-20px;">
						<?php foreach ($arti as $res): ?>
							<li>
								<div class="media">
									<div class="media-body">
										<b><span class="glyphicon glyphicon-user"></span> <span class="arti-title blue-font bold font-open"><?=$res['user_name']?> Says:</span></b>
										<p><span class="glyphicon glyphicon-comment"></span> <span class="arti-content font-source"> <?=$res['article']?></span></p>
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
					<a class="gold-font font-source" href=""><span class="glyphicon glyphicon-plus"></span>Create new</a>
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
				<span class="glyphicon glyphicon-facetime-video"></span> MATCHES TODAY
			</h4>
			<ul class="no-style match-today-ul">
				<li>
					<div class="media">
					<span class="pull-left glyphicon glyphicon-calendar font-size-25"></span>
					<div class="media-body">
						<span class="font-source font-size-16">Pakistan vs Zimbabwe</span>
						<small>09:00:00 | 14:00:00 (IST) | Gaddafi Stadium, Lahore</small>
					</div>
					</div>
				</li>
			</ul>
			<a href="<?=site_url()?>" class="gold-font"><span class="glyphicon glyphicon-link"></span> More</a>
		</div>
		<div class="border  padding-9 margin-top-5">
			<h4 class="heading">
				<span class="glyphicon glyphicon-star"></span> LIVE SCORE
			</h4>
			<div class="live-score-iframe">
				<!--
				<script src="//www.cricruns.com/system/application/views/widgetBase/wid_300_200_2_wo_ad.js" type="text/javascript"></script>
				-->
			</div>
		</div>
	</div>
</div>