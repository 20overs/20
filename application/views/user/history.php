<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<div class="col-lg-8 col-md-8">
					<div class="panel-group" id="accordion">
					  <div class="panel panel-info">
					    <div class="panel-heading" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
					        <center><span class="h4 handover">CREATE BATTING HISTORY</span></center>
					    </div>
					    <div id="collapseOne" class="panel-collapse collapse">
					      <div class="panel-body">
						      <div class="col-lg-12">
                              <form action="#" method="post" id="batting_history">
						      <h3>Match details</h3>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
							     	<div class="form-group">
										<label for="id">Player ID</label>
										<input type="number" class="form-control form-control-cust" id="id" placeholder="Player ID" required name="id">
									</div>
									<div class="form-group">
										<label for="match_date">Match Date</label>
										<input type="text" class="form-control datepicker form-control-cust" id="match_date" placeholder="Match date" required name="match_date" onchange="ValidateDate(this.value)">
									</div>
									<div class="form-group">
										<label for="match_result">Match Result</label>
									<input type="text" class="form-control form-control-cust" id="match_result" placeholder="Match Result" required name="match_result">
									</div>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<label for="your_team">Your Team Name</label>
										<input type="text" class="form-control form-control-cust" id="your_team" placeholder="Your Team Name" required="" name="your_team">
									</div>
									<div class="form-group">
										<label for="venue">Match venue</label>
										<input type="text" class="form-control form-control-cust" id="venue" placeholder="Match venue" required="" name="venue">
									</div>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<label for="opp_team">Opponent team</label>
										<input type="text" class="form-control form-control-cust" id="opp_team" placeholder="Opponent team" required="" name="opp_team">
									</div>
									<div class="form-group">
										<label for="overs">Overs</label>
										<input type="number" class="form-control form-control-cust" id="overs" placeholder="Overs" required="" name="overs">
									</div>
							      </div>
						      </div>

						      <div class="col-lg-12">
						      <h3>History</h3>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
							     	<div class="form-group">
										<label for="batting_order">Batting Order</label>
										<select class="form-control form-control-cust" id="batting_order" name="batting_order" required>
											<option value="">Select Batting Order</option>
						                    <option value="Opening Batsman">Opening Batsman</option>
						                    <option value="Top Order">Top Order</option>
						                    <option value="Middle Order">Middle Order</option>
						                    <option value="Lower Order">Lower Order</option>
										</select>
									</div>
                                    <div class="form-group">
                                        <label for="balls_faced">Balls Faced</label>
                                        <input type="number" class="form-control form-control-cust" id="balls_faced" placeholder="Balls Faced" required name="balls_faced">
                                    </div>
                                    <br><span id="bat_result"></span>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<label for="batting_position">Batting Position</label>
										<select class="form-control form-control-cust" id="batting_position" name="batting_position" required>
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
									</div>
                                    <div class="form-group">
                                        <label for="runs_scored">Runs Scored</label>
                                        <input type="number" class="form-control form-control-cust" id="runs_scored" placeholder="Runs Scored" required name="runs_scored">
                                    </div>
							      </div>
							      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="_4s">Number Of 4(s)</label>
                                        <input type="number" class="form-control form-control-cust" id="_4s" placeholder="Number Of 4(s)" required name="_4s">
                                    </div>
                                    <div class="form-group">
                                        <label for="_6s">Number Of 6(s)</label>
                                        <input type="number" class="form-control form-control-cust" id="_6s" placeholder="Number Of 6(s)" required name="_6s">
                                    </div>
                                    <button type="submit" class="btn search-btn">SAVE BATTING HISTORY</button>
							      </div>
						      </div>
                              </form>
						  </div>
					    </div>
					  </div>
					  <div class="panel panel-info">
					    <div class="panel-heading" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion">
					        <center><span class="h4 handover">CREATE BOWLING HISTORY</span></center>
					    </div>
					    <div  id="collapseTwo" class="panel-collapse collapse">
					      <div class="panel-body">
                                <div class="col-lg-12">
                    <form action="#" method="post" id="bowling_history">
                                  <h3>Match details</h3>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label for="id">Player ID</label>
                                            <input type="number" class="form-control form-control-cust" id="id" placeholder="Player ID" required name="id">
                                        </div>
                                        <div class="form-group">
                                            <label for="match_date">Match Date</label>
                                            <input type="text" class="form-control datepicker form-control-cust" id="match_date" placeholder="Match date" required name="match_date">
                                        </div>
                                        <div class="form-group">
                                            <label for="match_result">Match Result</label>
                                        <input type="text" class="form-control form-control-cust" id="match_result1" placeholder="Match Result" required name="match_result">
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label for="your_team">Your Team Name</label>
                                            <input type="text" class="form-control form-control-cust" id="your_team" placeholder="Your Team Name" required="" name="your_team">
                                        </div>
                                        <div class="form-group">
                                            <label for="venue">Match venue</label>
                                            <input type="text" class="form-control form-control-cust" id="venue" placeholder="Match venue" required="" name="venue">
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label for="opp_team">Opponent team</label>
                                            <input type="text" class="form-control form-control-cust" id="opp_team" placeholder="Opponent team" required="" name="opp_team">
                                        </div>
                                        <div class="form-group">
                                            <label for="overs">Overs</label>
                                            <input type="number" class="form-control form-control-cust" id="overs" placeholder="Overs" required="" name="overs">
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-lg-12">
                                  <h3>History</h3>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label for="bowling_type">Bowling Type</label>
                                            <select class="form-control form-control-cust" id="bowling_type" name="bowling_type" required>
                                                <option>Select a bowling style</option>
                                                <option value="0">Not a bowler</option>
                                                <option value="1">Pace Bowling</option>
                                                <option value="2">Spin Bowling</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="overs_bowled">Overs Bowled</label>
                                            <input type="number" class="form-control form-control-cust" id="overs_bowled" placeholder="Overs Bowled" required name="overs_bowled">
                                        </div>
                                        <span id="bow_result"></span>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label for="bowling_style">Bowling Style</label>
                                            <select class="form-control form-control-cust" id="bowling_style" name="bowling_style" required>
                                                <option value="">Select Batting Style</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="runs_given">Runs Given</label>
                                            <input type="number" class="form-control form-control-cust" id="runs_given" placeholder="Runs Given" required name="runs_given">
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label for="total_wickets">Total Wickets</label>
                                            <input type="number" class="form-control form-control-cust" id="total_wickets" placeholder="Total Wickets" required name="total_wickets">
                                        </div>
                                        <button type="submit" class="btn search-btn">SAVE BOWLING HISTORY</button>
                                      </div>
                                  </div>
                                  </form>
                              </div>
                            </div>
                          </div>

					  <div class="panel panel-info">
					    <div class="panel-heading" class="panel-heading" href="#collapseThree" data-toggle="collapse" data-parent="#accordion">
					        <center><span class="h4 handover">MANAGE HISTORY</span></center>
					    </div>
					    <div  id="collapseThree" class="panel-collapse collapse in">
					      <div class="panel-body">

					  		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h4>Batting histories</h4>
                                <ul class="list-group">
                                <?php
                                if(count($batting_history) < 1){
                                ?>
                                <li class="list-group-item">No Batting history is found</li>
                                <?php
                                }else{
                                    foreach ($batting_history as $row) {
                                ?>
                                    <li class="list-group-item"><?=$row['MyTeamName']?> vs <?=$row['OpponentTeam']?>|<small><?=$row['MatchDate']?> @ <?=$row['MatchVenue']?></small><span data-id="<?=$row['Id']?>" class="btn btn-xs btn-danger pull-right delete_batting">X</span>
                                    </li>
                                <?php
                                    }
                                ?>
                                </ul>
                                <?php
                                    }
                                ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h4>Bowling histories</h4>
                                <ul class="list-group">
                                <?php
                                if(count($bowling_history) < 1){
                                ?>
                                <li class="list-group-item">No Bowling history is found</li>
                                <?php
                                }else{
                                    foreach ($bowling_history as $row) {
                                ?>
                                    <li class="list-group-item"><?=$row['MyTeamName']?> vs <?=$row['OpponentTeam']?>|<small><?=$row['MatchDate']?> @ <?=$row['MatchVenue']?></small><span  data-id="<?=$row['Id']?>" class="delete_bowling btn btn-xs btn-danger pull-right">X</span>
                                    </li>
                                <?php
                                    }
                                ?>
                                </ul>
                                <?php
                                    }
                                ?>
                            </div>

					      </div>
					    </div>
					  </div>
				</div>
		</div>
	</div>
</div>
<script>
function ValidateDate(dtValue)
{
var dtRegex = new RegExp(/^\d{4}-\d{1,2}-\d{1,2}$/);
    if(dtRegex.test(dtValue)){
        return true;
    }else{
        return false;
    }
}
</script>