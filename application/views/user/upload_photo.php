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
				        <center><span class="h4">Recover Your Player Profile Id</span></center>
				    </div>
			    	<div class="panel-body">
			    		<form action="<?=base_url()?>user/do_upload" method="post" enctype="multipart/form-data">
		                    <div class="form-group">
		                        <label class="form-label-cust">Select a picture :</label>
		                        <input type="file" class="form-control  form-control-cust" name="userfile">
		                        <input type="submit" value="UPDATE PROFILE PIC" class="btn btn-xs btn-default">
		                    </div>
	                  	</form>
			      	</div>
			    </div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>