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
        <div class="panel-heading" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion">
            <center><span class="h4 handover">CREATE BOWLING HISTORY</span></center>
        </div>
        <div>
          <div class="panel-body">
            <div class="col-lg-12">
            <form action="<?=site_url()?>user/create_bowling_history" method="post" id="bowling_history">
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
                        <label for="bowling_type">Bowling Type</label>
                        <select class="form-control form-control-cust" id="bowling_type" name="bowling_type" value="<?php echo set_value('bowling_type'); ?>">
                            <option value="">Select a bowling style</option>
                            <option value="0">Not a bowler</option>
                            <option value="1">Pace Bowling</option>
                            <option value="2">Spin Bowling</option>
                        </select>
                        <?php echo form_error('bowling_type'); ?>
                    </div>
                    <div class="form-group">
                        <label for="overs_bowled">Overs Bowled</label>
                        <input type="number" min="0" class="form-control form-control-cust" id="overs_bowled" placeholder="Overs Bowled" name="overs_bowled" value="<?php echo set_value('overs_bowled'); ?>">
                    </div>
                    <?php echo form_error('overs_bowled'); ?>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="form-group">
                        <label for="bowling_style">Bowling Style</label>
                        <select class="form-control form-control-cust" id="bowling_style" name="bowling_style">
                            <option value="">Select Batting Style</option>
                        </select>
                        <?php echo form_error('bowling_style'); ?>
                    </div>
                    <div class="form-group">
                        <label for="runs_given">Runs Given</label>
                        <input type="number" min="0" class="form-control form-control-cust" id="runs_given" placeholder="Runs Given" name="runs_given" value="<?php echo set_value('runs_given'); ?>">
                        <?php echo form_error('runs_given'); ?>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="form-group">
                        <label for="total_wickets">Total Wickets</label>
                        <input type="number" min="0" class="form-control form-control-cust" id="total_wickets" placeholder="Total Wickets" name="total_wickets" value="<?php echo set_value('total_wickets'); ?>">
                        <?php echo form_error('total_wickets'); ?>
                    </div>
                    <button type="submit" class="btn search-btn">SAVE BOWLING HISTORY</button>
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