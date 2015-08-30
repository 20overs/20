<div class="container-fluid margin-top-5">
	<div class="row">
		<div class="col-lg-4 col-md-4">
			<?php
				echo $this->load->view('inc/sidebar');
			?>
		</div>
		<?php
		if($this->session->userdata('logged_in')!==TRUE){
		?>
		<div class="container">
			<div class="alert alert-info text-center"><h1>Login to post article</h1></div>
		</div>
		<?php
		}else{
		?>
		<div class="col-lg-8 col-md-8">
			<div class="panel-group" id="accordion">
					  <div class="panel panel-info">
					    <div class="panel-heading">
					        <center><span class="h4">Post Articles</span></center>
					    </div>
					      <div class="panel-body">
						      <div class="col-lg-12">
						      <form method="post" id="arti_form">
						      	<div class="form-group">
									<label for="name">Your Name</label>
									<input type="text" id="name" name="name" value="<?=$this->session->userdata('name')?>" class="form-control form-control-cust" disabled>
								</div>
								<div class="form-group">
								  <label for="name">Select Title</label>
								  <select class="form-control form-control-cust" id="matchid">
									<option value="0">Select a match</option>
									<?php
								  if(count($articles) > 0){
									foreach ($articles as $row) {
									?>
										<option value="<?=$row["Team1Name"]?> vs <?=$row["Team2Name"]?>"><?=$row["Team1Name"]?> vs <?=$row["Team2Name"]?></option>
									<?php
										}
									}else{
									?>
									<option value="India">India</option>
									<option value="Sachin">Sachin</option>
									<option value="Dhoni">Dhoni</option>
									<option value="Dravid">Dravid</option>
									<option value="Rohith">Rohith</option>
									<option value="Kholi">Kholi</option>
									<option value="Suresh Raina">Suresh Raina</option>
									<?php
									}
									?>
								  </select>
								</div>
								<div class="form-group">
									<textarea id="arti" name="arti" maxlength="250" class="form-control form-control-cust" placeholder="Write Your Article" style="display:none;" required></textarea>
									<?php
									if($this->session->userdata('admin')==1){
									?>
									<input type="url" name="link" class="form-control" placeholder="Article link" id="link" name="link" style="display:none;" />
									<?php
									}
									?>
								</div>
								<div class="badge badge-success" id="countdown" style="display:none;">250 characters remaining.</div>
								<div> &nbsp; </div>
								<input type="submit" name="sub" class="btn btn-primary" id="arti_submit"  style="display:none;" value="Post Article"/>
							</form>
							<br>
							<div id="op"></div>
							<br>
							<div id="ajax"></div>
                          </div>
                          </div>
                       </div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>