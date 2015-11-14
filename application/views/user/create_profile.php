<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-lg-8 col-md-8">
		<form action="welcome" method="post" >
		<div class="col-lg-12 border padding-3">
		<div class="panel panel-info">
		   	<div class="panel-heading">
		  <h3 class="panel-title text-center">CREATE PLAYER PROFILE</h3>
		 	</div>
		 	<div class="panel-body">
		
				<div class="col-lg-6">
				<div class="form-group">
					<label>Date Of Birth</label>
					<input type="text" class="form-control datepicker form-control-cust" id="dob"  name="dob" value="<?php echo set_value('dob'); ?>" required>
					<?php echo form_error('dob'); ?>
				</div>	
				<div class="form-group">
					<label>Height(Cms)</label>
					<input type="number" class="form-control form-control-cust" id="height"  name="height" value="<?php echo set_value('height'); ?>" required>
					<?php echo form_error('height'); ?>
				</div>
				<div class="form-group">
					<label>Weight(Kgs)</label>
					<input type="number" class="form-control form-control-cust" id="weight"  name="weight" value="<?php echo set_value('weight'); ?>" required>
					<?php echo form_error('weight'); ?>
				</div>
				</div>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Country</label>
					<select class="form-control form-control-cust" id="country1" name="country" value="<?php echo set_value('country'); ?>" required>
					<option value="">Select country</option>
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
                    <?php echo form_error('country'); ?>
				</div>
				<div class="form-group">
					<label>State</label>
					<select class="form-control form-control-cust" id="state1" name="state" value="<?php echo set_value('state'); ?>" required>
					<option value="">Select state</option>
                    </select>
                    <?php echo form_error('state'); ?>
				</div>
				<div class="form-group">
					<label>City</label>
					 <select class="form-control  form-control-cust" id="city1" name="city" value="<?php echo set_value('city'); ?>" required>
					 <option value="">Select city</option>
                    </select>
                    <?php echo form_error('city'); ?>
				</div>
				<div class="form-group">
					<label>Postal code</label>
					<input type="number" class="form-control form-control-cust" id="postal"  name="postal" value="<?php echo set_value('postal'); ?>" required>
					<?php echo form_error('postal'); ?>
				</div>
				</div>
			</div>
			
			<div class="col-lg-12 border padding-3 margin-top-5">
			<h4 class="text-center">PLAYER STYLE</h4>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Batting Style</label>
					 <select class="form-control  form-control-cust" id="batting" name="batting" required>
                        <option value="">Select batting style</option>
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
                    <?php echo form_error('batting'); ?>
				</div>
				<div class="form-group">
					<label>Do you keep wicket?</label>
					 <select class="form-control  form-control-cust" id="wicket" name="wicket" required>
					 <option value="N">No</option>
                    <option value="Y">Yes</option>
                    </select>
                    <?php echo form_error('wicket'); ?>
				</div>				
				</div>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Bowling Style</label>
					<select class="form-control  form-control-cust" id="bowling" name="bowling" required>
                        <option value="">Select bowling style</option>
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
	                <?php echo form_error('bowling'); ?>
				</div>
				<div class="form-group">
					<label>Have you captained?</label>
					<select class="form-control  form-control-cust" id="captained" name="captained" value="<?php echo set_value('captained'); ?>" required>
					 <option value="N">No</option>
                    <option value="Y">Yes</option>
                    </select>
                    <?php echo form_error('captained'); ?>
				</div>
				</div>
			</div>
			
			<div class="col-lg-12 border padding-3 margin-top-5">
			<h4 class="text-center">ADDITIONAL DETAILS</h4>
				<div class="col-lg-6">
				<div class="form-group">
					<label>I Am From</label>
				<select class="form-control  form-control-cust" id="iamfrom" name="iamfrom" value="<?php echo set_value('iamfrom'); ?>" required>
	                <option>An Organization</option>
	                <option>Sports Club</option>
	                <option>Sports Association</option>
	                <option>School</option>
	                <option>College</option>
	                <option>Other</option>
                </select>
                <?php echo form_error('iamfrom'); ?>
				</div>
				<div class="form-group">
					<label>I am</label>
					 <select class="form-control  form-control-cust" id="iam" name="iam" value="<?php echo set_value('iam'); ?>" required>
                    <option value="">N/A</option>
                    <option value="A Trainer in Bowling">A Trainer in Bowling</option>
                    <option value="A Trainer in Batting">A Trainer in Batting</option>				
                    <option value="A Coach of both Batting & Bowling">A Coach of both Batting & Bowling</option>
                    <option value="In need of a Trainer">In need of a Trainer</option>
                    <option value="In need of a Sponsor">In need of a sponsor</option>
                    </select>
                    <?php echo form_error('iam'); ?>
				</div>
				</div>
				<div class="col-lg-6">
				<div class="form-group">
					<label>Organizer Name</label>
					 <input type="text" class="form-control form-control-cust" id="orgname"  name="orgname" value="<?php echo set_value('orgname'); ?>" required>
					 <?php echo form_error('orgname'); ?>
				</div>
				<div class="form-group">
					<label>I agree 20overs.com to disclose my contact information (email) for any sponsers</label>
					<br>
					<select class="form-control  form-control-cust" id="agree" name="agree" value="<?php echo set_value('agree'); ?>" required>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    </select>
                    <?php echo form_error('agree'); ?>
				</div>
				</div>
			</div>
			<div class="col-lg-12 text-center margin-top-5">
				<div class="form-group">
					<span id="result"></span>
					<button type="submit" class="btn search-btn">SAVE PLAYER PROFILE</button>
				</div>
			</div>
			</div>
			</form>
		</div>
		</div>
	</div>
</div>
<script>
$('#country1').change(function(e){
    var id = $(this).val();
    var opt="<option value=''>Select state</option>";
    $.post('get_states/',{id:id},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.stateid+"'>"+value.name+"</option>";
        });
        $('#state1').html(opt);
        $('#city1').html("<option value=''>Select city</option>");
    });
    e.preventDefault();
  });

  $('#state1').change(function(){
    var opt="<option value=''>Select city</option>";
    $.post('get_cities/',{country:$('#country1').val(),state:$(this).val()},function(data){
        var obj = jQuery.parseJSON(data);
        $.each( obj, function( key, value ) {
            opt += "<option value='"+value.id+"'>"+value.city_name+"</option>";
        });
        $('#city1').html(opt);
    });
  });
</script>