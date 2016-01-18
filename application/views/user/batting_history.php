<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-lg-8 col-md-8">
					<div class="panel-group">
					  <div class="panel panel-info">
					    <div class="panel-heading">
					        <center><span class="h4 handover">CREATE BATTING HISTORY</span></center>
					    </div>
					    <div class="panel-collapse">
					      <div class="panel-body">
						      <div class="col-lg-12">
                              <form action="<?=site_url()?>user/create_batting_history" method="post" id="batting_history_form">
						      <h3>Match details</h3>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
							     	<div class="form-group">
										<label for="pro_id">Player ID</label>
										<input type="number" min="0" class="form-control form-control-cust" id="pro_id" placeholder="Player ID"  name="pro_id" value="<?php echo set_value('pro_id'); ?>">
                                        <?php echo form_error('pro_id'); ?>
									</div>
									<div class="form-group">
										<label for="match_date">Match Date</label>
										<input type="text" class="form-control datepicker form-control-cust" id="match_date" placeholder="Match date [YYYY-MM-DD]"  name="match_date" value="<?php echo set_value('match_date'); ?>">
                                        <?php echo form_error('match_date'); ?>
									</div>
									<div class="form-group">
										<label for="match_result">Match Result</label>
									    <input type="text" class="form-control form-control-cust" id="match_result" placeholder="Match Result"  name="match_result" value="<?php echo set_value('match_result'); ?>">
                                        <?php echo form_error('match_result'); ?>
									</div>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<label for="your_team">Your Team Name</label>
										<input type="text" class="form-control form-control-cust" id="your_team" placeholder="Your Team Name" name="your_team" value="<?php echo set_value('your_team'); ?>">
                                        <?php echo form_error('your_team'); ?>
									</div>
									<div class="form-group">
										<label for="venue">Match venue</label>
										<input type="text" class="form-control form-control-cust" id="venue" placeholder="Match venue" name="venue" value="<?php echo set_value('venue'); ?>">
                                        <?php echo form_error('venue'); ?>
									</div>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<label for="opp_team">Opponent team</label>
										<input type="text" class="form-control form-control-cust" id="opp_team" placeholder="Opponent team" name="opp_team" value="<?php echo set_value('opp_team'); ?>">
                                        <?php echo form_error('opp_team'); ?>
									</div>
									<div class="form-group">
										<label for="overs">Overs</label>
										<input type="number" min="0" class="form-control form-control-cust" id="overs" placeholder="Overs" name="overs" value="<?php echo set_value('overs'); ?>">
                                        <?php echo form_error('overs'); ?>
									</div>
							      </div>
						      </div>

						      <div class="col-lg-12">
						      <h3>History</h3>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
							     	<div class="form-group">
										<label for="batting_order">Batting Order</label>
										<select class="form-control form-control-cust" id="batting_order" name="batting_order" value="<?php echo set_value('batting_order'); ?>">
											<option value="">Select Batting Order</option>
						                    <option value="Opening Batsman">Opening Batsman</option>
						                    <option value="Top Order">Top Order</option>
						                    <option value="Middle Order">Middle Order</option>
						                    <option value="Lower Order">Lower Order</option>
										</select>
                                        <?php echo form_error('batting_order'); ?>
									</div>
                                    <div class="form-group">
                                        <label for="balls_faced">Balls Faced</label>
                                        <input type="number" min="0" class="form-control form-control-cust" id="balls_faced" placeholder="Balls Faced"  name="balls_faced" value="<?php echo set_value('balls_faced'); ?>">
                                        <?php echo form_error('balls_faced'); ?>
                                    </div>
                                    <br><span id="bat_result"></span>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<label for="batting_position">Batting Position</label>
										<select class="form-control form-control-cust" id="batting_position" name="batting_position"  value="<?php echo set_value('batting_position'); ?>">
											<option value="">Select Batting Position</option>
						                    <option value="Opening-Striker">Opening-Striker</option>
						                    <option value="1st Down">1st Down</option>
						                    <option value="2nd Down">2nd Down</option>
						                    <option value="3rd Down">3rd Down</option>
						                    <option value="4th Down">4th Down</option>
						                    <option value="5th Down">5th Down</option>
						                    <option value="6th Down">6th Down</option>
						                    <option value="7th Down">7th Down</option>
						                    <option value="8th Down">8th Down</option>
						                    <option value="9th Down(Last)">9th Down(Last)</option>
									   	</select>
                                        <?php echo form_error('batting_position'); ?>
									</div>
                                    <div class="form-group">
                                        <label for="runs_scored">Runs Scored</label>
                                        <input type="number" min="0" class="form-control form-control-cust" id="runs_scored" placeholder="Runs Scored"  name="runs_scored" value="<?php echo set_value('runs_scored'); ?>">
                                        <?php echo form_error('runs_scored'); ?>
                                    </div>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="_4s">Number Of 4(s)</label>
                                        <input type="number" min="0" class="form-control form-control-cust" id="_4s" placeholder="Number Of 4(s)"  name="_4s" value="<?php echo set_value('_4s'); ?>">
                                        <?php echo form_error('_4s'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="_6s">Number Of 6(s)</label>
                                        <input type="number" min="0" class="form-control form-control-cust" id="_6s" placeholder="Number Of 6(s)"  name="_6s" value="<?php echo set_value('_6s'); ?>">
                                        <?php echo form_error('_6s'); ?>
                                    </div>
                                    <button type="submit" class="btn search-btn">SAVE</button> &nbsp; &nbsp; &nbsp;
                                    <button type="reset" class="btn search-btn">RESET</button>
							      </div>
						      </div>
                            </form>
						  </div>
					    </div>
					  </div>
				  </div>
			</div>
		</div>
	</div>
</div>