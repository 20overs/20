<div class="row margin-top-5">
			<div class="col-lg-6">
				<div class="border padding-9 clearfix">
					<h4 class="heading">
						<span class="glyphicon glyphicon-star"></span> SEARCH TALENT
					</h4>
					<div class="col-lg-6">
					<form id='searchtalent' action="<?=site_url()?>" method="post">
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
						<span class="glyphicon glyphicon-star"></span> TALENTS TODAY
					</h4>
					<div class="margin-left-3">

						<span class="glyphicon glyphicon-user user"></span>
						<span class="talent-today-name">
						<?php
							$curryear = date('Y');
							$doby = explode("-",$talent[0]["DOB"]);
							$age = $curryear-$doby[0];
							foreach ($talent as $row):
						?>
							<a href='<?=$row['Id']+674539873?>' class="user"><?=$row['fullname']?></a>
						</span>
					</div>
							<ul class="no-style talent-ul">
								<li>
									<h5><span class="glyphicon glyphicon-ok-sign"></span> <?=$age?> Yrs</h5>
								</li>
								<li>
									<h5><span class="glyphicon glyphicon-ok-sign"></span> <?=$row['BattingStyle']?></h5>
								</li>
								<li>
									<h5><span class="glyphicon glyphicon-ok-sign"></span> <?=$row['BowlingStyle']?></h5>
								</li>
								<li>
									<h5><span class="glyphicon glyphicon-ok-sign"></span> <?=$row['city_name']?> , <?=$row['Country']?></h5>
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
			        	<span class="glyphicon glyphicon-star"></span> RECENT USERS
			        </h4>
					<ul class="no-style recent-ul">
						<?php
						foreach ($recent as $row):
						?>
							<li>
								<h5><span class="glyphicon glyphicon-heart"></span> <?=$row['Firstname']?>
							</li>
						<?php
						endforeach;
						?>
					</ul>
				</div>
			</div>
</div>