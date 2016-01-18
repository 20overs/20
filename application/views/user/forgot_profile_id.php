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
			<div class="alert alert-info text-center"><h1>Please Login</h1></div>
		</div>
		<?php
		}else{
		?>
		<div class="col-lg-8 col-md-8">
			<div class="panel-group" id="accordion">
				<div class="panel panel-info">
				    <div class="panel-heading">
				        <center><span class="h4">Recover Your Player Profile Id</span></center>
				    </div>
			    	<div class="panel-body">
			    		<div class="container-fluid">
			                <form action="#" id="recover_mail">
			                    <div class="form-group">
			                        <label class="form-label-cust">Enter your recover email ID :</label>
			                        <input type="email" class="form-control  form-control-cust" name="recover_mail" placeholder="Enter your email ID">
			                        <input type="submit" value="Send Email" class="btn btn-xs btn-default" id="recover_mail_submit">
			                        <div id="recover_email_res"></div>
			                    </div>
			                </form>
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