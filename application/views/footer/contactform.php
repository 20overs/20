<div class="container">
	 	<div class="col-lg-6">
            <div class="contact-adress">
                <h3>Contact Address</h3>                                
                <h4>Chennai - Corporate Office:</h4>
                <p class="h4 font-source">
                    1D, Plot 415 <br />
                    2nd Main Road, 9th Cross Street <br />
                    Narayanapuram <br />
                    Kamakoti Nagar <br />
                    Pallikaranai <br />
                    Chennai 600100 <br />
                    Tamil Nadu, India
                </p>
                <h4>Madurai - Branch Office:</h4>
                <p class="h4 font-source">
                    25A/2 <br />
                    Erwadi Pallivasal Street <br />
                    Villapuram <br />
                    Madurai 625012 <br />
                    Tamil Nadu, India
                </p>
            </div>
        </div>
			<div class="col-lg-6">
			<h3>Contact Form</h3>
      <form role="form" method="post" id="comm" action="<?=site_url('welcome/postcontactform')?>">
<div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
   </div>
   <div class="form-group">
      <label for="name">Email Id:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
   </div>
			<div class="form-group">
      <label for="name">Select list</label>
      <select class="form-control" 	id="ihavea" name="ihavea" required>
		<option>------select--------</option>
		<option value="C">Question/Comments</option>
		<option value="F">Feedback</option>
		<option value="A">Advertisement</option>
		</select>
	  </div>
	  <div class="form-group">
    <label for="name">Comments</label>
    <textarea class="form-control" maxlength="250" placeholder="Maximum 250 characters" name="comments" id="comments" rows=2 required></textarea>
  </div>
   <button type="submit" class="btn btn-info">Submit</button> &nbsp; <span id="res"></div>
</form>
</div>