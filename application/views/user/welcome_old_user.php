<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-lg-8 col-md-8">
		<?php
		foreach ($profile as $pro) {
		?>
		<form action="#" method="post" id="update_profile">
		<div class="col-lg-12 border padding-3">
		<div class="panel panel-info">
		   	<div class="panel-heading">
		  <h3 class="panel-title text-center">YOUR PLAYER PROFILE</h3>
		 	</div>
		 	<div class="panel-body">
			
				<div class="col-lg-6">
				<div class="form-group">
					<label>Date Of Birth</label>
					<input type="text" class="form-control datepicker form-control-cust" id="dob" required name="dob" value="<?=$pro['DOB']?>">
				</div>
				<div class="form-group">
					<label>Height(Cms)</label>
					<input type="number" class="form-control form-control-cust" id="height" required name="height" value="<?=$pro['Height']?>">
				</div>
				<div class="form-group">
					<label>Weight(Kgs)</label>
					<input type="number" class="form-control form-control-cust" id="weight" required name="weight" value="<?=$pro['Weight']?>">
				</div>
				</div>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Country</label>
					<select class="form-control form-control-cust" id="country" name="country" required>
					<option  value="<?=$pro['Country']?>"><?=$pro['Country1']?></option>
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
				<div class="form-group">
					<label>State</label>
					<select class="form-control form-control-cust" id="state" name="state" required>
					<option value="<?=$pro['State']?>"><?=$pro['State1']?></option>
                    </select>
				</div>
				<div class="form-group">
					<label>City</label>
					 <select class="form-control  form-control-cust" id="city" name="city" required>
					 <option value="<?=$pro['City']?>"><?=$pro['City1']?></option>
                    </select>
				</div>
				<div class="form-group">
					<label>Postal code</label>
					<input type="number" class="form-control form-control-cust" id="postal" required name="postal" value="<?=$pro['PostalCode']?>">
				</div>
				</div>
			</div>
			
			<div class="col-lg-12 border padding-3 margin-top-5">
			<h4 class="text-center">PLAYER STYLE</h4>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Batting Style</label>
					 <select class="form-control  form-control-cust" id="batting" name="batting" required>
                        <option  value="<?=$pro['BattingStyle']?>"><?=$pro['BattingStyle']?></option>
	                    <?php
	                    foreach ($batting as $count) {
	                    ?>
	                    	<option value="<?=$count['name']?>">
	                    		<?=$count['name']?>
	                    	</option>
	                    <?php
	                    }
	                    ?>
                    </select>
				</div>
				<div class="form-group">
					<label>Do you keep wicket?</label>
					 <select class="form-control  form-control-cust" id="wicket" name="wicket" required>
					 <option  value="<?=$pro['DoYouKeepWicket']?>">
					 <?php
					 if($pro['DoYouKeepWicket']=='N'){
					 	echo "No";
					 }else{
					 	echo "Yes";
					 }
					 ?>
					 </option>
					 <option value="N">No</option>
                     <option value="Y">Yes</option>
                    </select>
				</div>				
				</div>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Bowling Style</label>
					<select class="form-control  form-control-cust" id="bowling" name="bowling" required>
                        <option value="<?=$pro['BowlingStyle']?>"><?=$pro['BowlingStyle']?></option>
	                    <?php
	                    foreach ($bowling as $count) {
	                    ?>
	                    	<option value="<?=$count['name']?>">
	                    		<?=$count['name']?>
	                    	</option>
	                    <?php
	                    }
	                    ?>                    
	                    </select>
				</div>
				<div class="form-group">
					<label>Have you captained?</label>
					<select class="form-control  form-control-cust" id="captained" name="captained" required>
					<option  value="<?=$pro['HaveYouCaptained']?>">
					 <?php
					 if($pro['HaveYouCaptained']=='N'){
					 	echo "No";
					 }else{
					 	echo "Yes";
					 }
					 ?>
					 <option value="N">No</option>
                    <option value="Y">Yes</option>
                    </select>
				</div>
				</div>
			</div>
			
			<div class="col-lg-12 border padding-3 margin-top-5">
			<h4 class="text-center">ADDITIONAL DETAILS</h4>
				<div class="col-lg-6">
				<div class="form-group">
					<label>I Am From</label>
				<select class="form-control  form-control-cust" id="iamfrom" name="iamfrom" required>
					<option value="<?=$pro['PlayerOrgBy']?>"><?=$pro['PlayerOrgBy']?></option>
	                <option>An Organization</option>
	                <option>Sports Club</option>
	                <option>Sports Association</option>
	                <option>School</option>
	                <option>College</option>
	                <option>Other</option>
                </select>
				</div>
				<div class="form-group">
					<label>I am</label>
					 <select class="form-control  form-control-cust" id="iam" name="iam" required>
                    <option value="<?=$pro['IAm']?>"><?=$pro['IAm']?></option>
                    <option value="A Trainer in Bowling">A Trainer in Bowling</option>
                    <option value="A Trainer in Batting">A Trainer in Batting</option>				
                    <option value="A Coach of both Batting & Bowling">A Coach of both Batting & Bowling</option>
                    <option value="In need of a Trainer">In need of a Trainer</option>
                    <option value="In need of a Sponsor">In need of a sponsor</option>
                    </select>
                    </select>
				</div>
				</div>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Organizer Name</label>
					 <input type="text" class="form-control form-control-cust" id="orgname" required name="orgname" value="<?=$pro['PlayerOrgName']?>">
				</div>
				<div class="form-group">
					<label>I agree 20overs.com to disclose my contact information (email) for any sponsers</label>
					<br>
					<select class="form-control  form-control-cust" id="agree" name="agree" required>
					<option  value="<?=$pro['Disclosure']?>">
					 <?php
					 if($pro['Disclosure']=='N'){
					 	echo "No";
					 }else{
					 	echo "Yes";
					 }
					 ?>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    </select>
				</div>
				</div>
			</div>
			<div class="col-lg-12 text-center margin-top-5">
				<div class="form-group">
					<span id="result"></span>
					<button type="submit" class="btn search-btn">UPDATE PLAYER PROFILE</button>
				</div>
			</div>
			</div>
			</form>
			<?
			}
			?>
		</div>
		<!--
		<div class="panel panel-info">
		   	<div class="panel-heading">
		      <h3 class="panel-title text-center">CREATE HISTORY</h3>
		   	</div>
		  	<div class="panel-body">
				<div class="col-lg-6">
					<div class="panel panel-success">
					   	<div class="panel-heading">
					      <h3 class="panel-title text-center">BATTING HISTORY</h3>
					   	</div>
					  	<div class="panel-body">
					  		<div class="form-group">
								<label for="inputEmail">Player ID</label>
								<input type="text" class="form-control form-control-cust" id="inputEmail" placeholder="Player ID" required="" name="id">
							</div>
					   	</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="panel panel-success">
					   	<div class="panel-heading">
					      <h3 class="panel-title text-center">BOWLING HISTORY</h3>
					   	</div>
					  	<div class="panel-body">
					  	
					   	</div>
					</div>
				</div>
			</div>
		</div>
		-->
		</div>
	</div>
</div>