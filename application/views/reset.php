<div class="container-fluid margin-top-5">
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
		<form method="post" action="<?=site_url('welcome/doreset')?>">
				<div class="form-group">
					<label for="emailid">Password</label>
					<input type="password" class="form-control" id="pass" placeholder="Enter password" required name="pass">
				</div>
				<div class="form-group">
					<label for="emailid">Re enter password</label>
					<input type="password" class="form-control" id="repass" placeholder="Re-enter password" required name="repass">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Change Password</button> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<span id="resetres"></div>
				</div>
		</form>
	</div>
</div>