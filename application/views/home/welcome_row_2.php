    
	<div class="row margin-top-5 rows3">
		<div class="col-lg-3">
			<div class="border  padding-9">
				<h4 class="heading">
					<span class="glyphicon glyphicon-time"></span> TRENDING NOW
				</h4>
				<ul class="no-style trending-ul">
					<?php
						foreach ($trending as $row):
					?>
					<li>
						<span class="glyphicon glyphicon-stats"></span>
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
					<span class="glyphicon glyphicon-question-sign"></span> WHAT IS?
				</h4>
				<ul class="no-style trending-ul">
				<?php
				foreach ($whatis as $row):
				?>
					<li>
						<span class="glyphicon glyphicon-share-alt"></span>
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
					<span class="glyphicon glyphicon-question-sign"></span> GOOGLY
				</h4>
				<center><span class="glyphicon glyphicon-question-sign" style="font-size:50px;"></span></center>
				<div class="googly">
					<?php
					foreach ($quiz as $row):
					?>
						<p>
							<span class="glyphicon glyphicon-bell"></span>
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
				<span class="glyphicon glyphicon-pushpin"></span> EXTRAS
			   </h4>
			<ul class="no-style trending-ul">
				<?php
				foreach ($extras as $row):
				?>
				<li>
					<span class="glyphicon glyphicon-paperclip"></span>
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