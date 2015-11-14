<!--
'pending','accepted','rejected','blocked'
'friend','join_team','created_team'
-->
<div class="row">
	<div class="col l4 m4 s12">
		<?php echo $this->load->view('social/inc/side_bar.php');?>
	</div>
	<div class="col l5 m5 s12">
		<h1>Under construction</h1>
		<!--
		<div class="row">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s3"><a class="active" href="#test1">UPDATE STATUS</a></li>
		        <li class="tab col s3"><a href="#test2">UPLOAD PHOTO</a></li>
		      </ul>
		    </div>
		    <div id="test1" class="col s12">
		    	<div class="input-field col s12">
		    		<i class="material-icons prefix">mode_edit</i>
		          <textarea id="textarea1" class="materialize-textarea"></textarea>
		          <label for="textarea1">STATUS</label>
		        </div>
		        <a class="waves-effect waves-light btn indigo right"><i class="material-icons right">done</i>UPDATE</a>
		    </div>
		    <div id="test2" class="col s12">
		    	<form action="#">
				    <div class="file-field input-field">
				      <div class="btn">
				        <span>Upload photo</span>
				        <input type="file">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Upload a photo">
				      </div>
				    </div>
				    <a class="waves-effect waves-light btn indigo right"><i class="material-icons right">done</i>UPLOAD</a>
				  </form>
		    </div>
		  </div>

  		<div class="row">
		<div class="card blue-grey">
            <div class="card-content white-text">
            <a href="#" class="right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit"><i class="material-icons tiny white-text">message</i></a>
              <img src="http://www.20overs.com/uploads/3958541ce04a32e1f99cbaa54c5ee889.jpg" class="circle responsive-image" height="50" />
              <p class="card-title posted_by amber-text">Cv vikash</p>
              <p>
              Hi every one I am going to create a team any one interested message me!
              </p>
            </div>
            <div class="card-action white">
              <a href="#" class="indigo-text"><i class="material-icons tiny">thumb_up</i> Like</a>
              <a href="#" class="indigo-text">Comment</a>
            </div>
        </div>

        <div class="card blue-grey">
            <div class="card-content white-text">
            <a href="#" class="right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit"><i class="material-icons tiny white-text">message</i></a>
              <img src="http://www.20overs.com/uploads/3958541ce04a32e1f99cbaa54c5ee889.jpg" class="circle responsive-image" height="50" />
              <p class="card-title posted_by amber-text">Cv vikash</p>
              <p>
              	South Africa 200 for 3 (Duminy 68*, de Villiers 51) beat India 199 for 5 (Rohit 106, Kohli 43) by seven wickets. R Sharma ton outclassed by Duminy batting.
              </p>
            </div>
            <div class="card-action white white">
              <a href="#" class="indigo-text"><i class="material-icons tiny">thumb_up</i> Like</a>
              <a href="#" class="indigo-text">Comment</a>
            </div>
        </div>

        <div class="card blue-grey">
            <div class="card-content white-text">
              <img src="<?=site_url()?>uploads/talent.jpg" class="circle responsive-image" height="50" />
              <p class="card-title posted_by amber-text">Subramania Thanigaivel</p>
              <p>
              	Imad Wasim's four-for helps Pakistan defend 136. Pakistan 136 for 8 (Malik 35, Rizwan 33*, Chibhabha 3-18) beat Zimbabwe 123 for 9 (Chigumbura 31, Wasim 4-11) by 13 runs.
              </p>
            </div>
            <div class="card-action white i">
              <a href="#" class="indigo-text"><i class="material-icons tiny">thumb_up</i> Like</a>
              <a href="#" class="indigo-text">Comment</a>
            </div>
        </div>
        </div>
        -->
	</div>
	<div class="col l3 m3 s12">
		<div class="card section">
		    <div class="card-image waves-effect waves-block waves-light">
		      <img class="activator" src="<?=$this->session->userdata('image_url')?>">
		    </div>
		    <div class="card-content">
		      <span class="card-title activator grey-text text-darken-4"> <?=$this->session->userdata('name')?><i class="material-icons right">more_vert</i></span>
		      <p><a href="<?=site_url()?>user/view_profile/<?=$this->session->userdata('user_id_enc')?>">View your profile</a></p>
		    </div>
		    <div class="card-reveal">
		      <span class="card-title grey-text text-darken-4">About me<i class="material-icons right">close</i></span>
		      <h5></h5>
		      <p>I am a player of "Bangalore boys" team.</p>
		      <a href="#" class="right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit"><i class="material-icons tiny black-text">message</i></a>
		    </div>
		  </div>
	</div>
</div>
<style type="text/css">
	.posted_by{
		margin-top: -50px !important;
		margin-left: 50px !important;
	}
</style>
<script type="text/javascript">
/*	 var options = [
    {selector: '.section', offset: 200, callback: 'fun()' },
	  ];
	  Materialize.scrollFire(options);

	  function fun(){
	  	$(function(){
	  		$('.section').css('position','fixed');
	  	});
	  }
*/
</script>