<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$this->load->model('site');
		$this->load->model('locations');
		$this->load->library('form_validation');
		$this->load->library('MY_Form_validation');
		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
		die();
	}

	public function welcome(){

		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$data['countries'] = $this->locations->get_countries();
		$data['batting'] = $this->locations->get_batting_style();
		$data['bowling'] = $this->locations->get_bowling_style();
		$check_player_profile =  $this->locations->check_player_profile();
		$data['title'] = "My profile";
		$this->load->view('inc/header',$data);

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('dob', 'Date of birth','required|valid_date[y-m-d,-]');
		$this->form_validation->set_rules('height','Height','required|numeric|less_than[250]');
		$this->form_validation->set_rules('weight','Weight','required|numeric|less_than[200]');

		$this->form_validation->set_rules('country','Country','required');
		$this->form_validation->set_rules('state','State','required');
		$this->form_validation->set_rules('city','City','required');
		$this->form_validation->set_rules('postal','Postal','required|numeric');

		$this->form_validation->set_rules('batting','Batting style','required');
		$this->form_validation->set_rules('bowling','Bowling style','required');
		$this->form_validation->set_rules('wicket','Wicket Keeping','required');
		$this->form_validation->set_rules('captained','Captained','required');

		$this->form_validation->set_rules('iamfrom','I am from','required');
		$this->form_validation->set_rules('iam','I am','required');
		$this->form_validation->set_rules('orgname','Organisation name','required');
		$this->form_validation->set_rules('agree','Agree','required');

		if($this->form_validation->run() == TRUE)
		{
			echo $this->create_profile();
		}
		if($check_player_profile > 0){
			$data['profile'] = $this->site->get_profile_logged_in();
			$this->load->view('user/create_profile_old',$data);
		}else{
			$this->load->view('user/create_profile');
		}
		$this->load->view('inc/footer');
	}

	function checkDateFormat($date)
	{
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
		{
			if(checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
				return true;
			else
				return false;
		}
		else
		{
		return false;
		}
	}

	public function articles(){
		$data['title'] = "Create articles";
		$data['articles'] = $this->site->articles_logged_in();
		$data['countries'] = $this->site->get_countries();
		$this->load->view('inc/header',$data);		
		$this->load->view('user/articles');
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
	public function add_articles(){
		$this->site->add_articles();
	}
	public function view_profile($getid)
	{
		if($getid == "")
		{
			redirect('/');
		}
		$data['title'] = "View profile";
		$this->load->view('inc/header',$data);
		$id = $getid - 674539873;
		$data['id'] = $id;
		$count = $this->users->profile_count($id);
		echo $id;
		if($count>0){
			$profile_id = $this->users->get_profile_id($id);
			$data['profile_pic'] = $this->users->get_profile_pic($profile_id);
			$data['style'] = $this->users->get_style($id);
			$data['name'] = $this->users->get_name($id);
			$data['batting_history'] = $this->users->pro_batting_history($id);
			$data['bowling_history'] = $this->users->pro_bowling_history($id);
			$data['six'] = $this->users->pro_get_six($id);
			$data['four'] = $this->users->pro_get_four($id);
			$data['location'] = $this->users->pro_get_location($id);
			$data['runs'] = $this->users->pro_get_runs($id);
			$data['wickets'] = $this->users->pro_get_wicket($id);

			$data['user_id'] = $this->users->get_profile_id($id);
			$data['profile_id'] = $getid;
			$logged_id = $this->users->get_user_id($this->session->userdata('user_id'));

			if($this->session->userdata('logged_in') !== FALSE && $this->session->userdata('user_id') !== $data['user_id']){

				$counts = $this->db->query('SELECT count(*) as nums FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?)',array($logged_id,$logged_id,$id,$id))->row()->nums;
				if($counts == 0)
				{
					$data['choice']	= 1;
				}else{
					$result = $this->db->query('SELECT * FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and request_type="friend"',array($logged_id,$logged_id,$id,$id))->row();
					if($result->sender_id == $logged_id && $result->status == "pending"){
						$data['choice']	= 2;
					}
					if($result->receiver_id == $logged_id && $result->status == "pending"){
						$data['choice']	= 3;
					}
					else if($result->status == "rejected")
					{
						$data['choice']	= 4;
					}
					else if($result->status == "accepted")
					{
						$data['choice']	= 5;
					}
					else if($result->status == "blocked")
					{
						$data['choice']	= 6;
						$data['alert'] = "danger";
						$data['message'] = "No profile found";
						$this->load->view('inc/message',$data);
						die();
					}

				}
			}else{
				$data['choice']	= 0;
			}
			$this->load->view('home/view_profile',$data);
		}else{
			$data['alert'] = "danger";
			$data['message'] = "No profile found";
			$this->load->view('inc/message',$data);
		}
		$this->load->view('inc/footer');
	}
	public function get_states(){
		$id = $this->input->post('id');
		$data = $this->locations->get_states($id);
		$res = array();
		foreach ($data as $key) {
			$res[] = $key;
		}
		echo json_encode($res);
	}
	public function get_cities(){
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$data = $this->locations->get_cities($country,$state);
		$res = array();
		foreach ($data as $key) {
			$res[] = $key;
		}
		echo json_encode($res);
	}
	function create_profile(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		if($this->input->post('batting')){
		$dob=preg_replace('/[a-zA-Z]/','',$this->input->post('dob',TRUE));
		$height = $this->input->post('height',TRUE);
		if($height < 0){$height *= -1;}
		$weight = $this->input->post('weight',TRUE);
		if($weight < 0){$weight *= -1;}
		$weight = $this->input->post('weight',TRUE);
		$country = $this->input->post('country',TRUE);
		$state = $this->input->post('state',TRUE);
		$city = $this->input->post('city',TRUE);
		$postal = $this->input->post('postal',TRUE);
		if($postal < 0){$postal *= -1;}
		$batting = $this->input->post('batting',TRUE);
		$bowling = $this->input->post('bowling',TRUE);
		$wicket = $this->input->post('wicket',TRUE);
		$captained = $this->input->post('captained',TRUE);
		$iamfrom =$this->input->post('iamfrom',TRUE);
		$iam = $this->input->post('iam',TRUE);
		$orgname = $this->input->post('orgname',TRUE);
		$agree = $this->input->post('agree',TRUE);

		$profile_count  =$this->db->query('SELECT count(*) as nums FROM player_profile where UserSysID=?',array($this->session->userdata('user_id')))->row()->nums;
		if($profile_count > 0){
			$sql = "UPDATE  `player_profile` SET `DOB` = ?,`Height`=? ,`Weight`=?,`Country`=? ,`State`=? ,`City`=? ,`PostalCode`=? ,`BattingStyle`=? ,`BowlingStyle`=? ,`DoYouKeepWicket`=? ,`HaveYouCaptained`=? ,`Disclosure`=?,`IAm`=? ,`PlayerOrgBy`=? ,`PlayerOrgName`=? WHERE `UserSysID`=?";
				if(!$this->db->query($sql,array($dob,$height,$weight,$country,$state,$city,$postal,$batting,$bowling,$wicket,$captained,$agree,$iam,$iamfrom,$orgname,$this->session->userdata('user_id'))))
				{
					$data['message'] = "Your player profile is already created.";
					$data['title'] = "Player profile already created";
					$this->load->view('message',$data);
				}
				else
				{
					$data['message'] = "Your player profile updated successfully.";
					$data['title'] = "Success";
					$this->load->view('message',$data);
				}
		}else{
			$sql = "INSERT INTO  `player_profile` (`Id` ,`UserSysID` ,`DOB` ,`Height` ,`Weight` ,`Country` ,`State` ,`City` ,`PostalCode` ,`BattingStyle` ,`BowlingStyle` ,`DoYouKeepWicket` ,`HaveYouCaptained` ,`Disclosure`,`IAm` ,`PlayerOrgBy` ,`PlayerOrgName` ,`CreateTS`) VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
			if(!$this->db->query($sql,array($this->session->userdata('user_id'),$dob,$height,$weight,$country,$state,$city,$postal,$batting,$bowling,$wicket,$captained,$agree,$iam,$iamfrom,$orgname)))
			{
				$data['message'] = "Your player profile is already created.";
				$data['title'] = "Player profile already created";
				$this->load->view('message',$data);
			}
			else
			{
				$data['message'] = "Your player profile is created successfully.";
				$data['title'] = "Success";
				$this->load->view('message',$data);
			}
		}

		$id = $this->db->insert_id();
		$this->db->trans_complete();
		}else{
			echo "<center>You dont have access to this page</center>";
		}
	}

	public function create_batting_history()
	{
		$data['title'] = "Create Batting history";
		$this->load->view('inc/header',$data);

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('pro_id', 'Profile ID','required|numeric');
		$this->form_validation->set_rules('match_date','date','required|valid_date[y-m-d,-]');
		$this->form_validation->set_rules('match_result','match result','required|alpha');
		$this->form_validation->set_rules('your_team','your team','required|alphanumeric');
		$this->form_validation->set_rules('venue','venue','required|alphanumeric');
		$this->form_validation->set_rules('opp_team','opponent team','required|alphanumeric');
		$this->form_validation->set_rules('overs','overs','required|numeric|less_than[51]');

		$this->form_validation->set_rules('batting_order','batting order','required');
		$this->form_validation->set_rules('balls_faced','balls faced','required');
		$this->form_validation->set_rules('batting_position','batting position','required');
		$this->form_validation->set_rules('runs_scored','runs scored','required|numeric');
		$this->form_validation->set_rules('_4s','4s','required|numeric');
		$this->form_validation->set_rules('_6s','6s','required|numeric');

		if($this->form_validation->run() == TRUE)
		{
			echo $this->save_batting_history();
		}
		if($this->input->get('success') == 1){
			$data['message'] = "Your Batting history saved successfully.";
			$data['title'] = "!";
			$this->load->view('message',$data);
		}
		$this->load->view('user/batting_history');
		$this->load->view('inc/footer');
	}

	public function create_bowling_history()
	{
		$data['title'] = "Create Bowling history";
		$this->load->view('inc/header',$data);

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('pro_id', 'Profile ID','required|numeric');
		$this->form_validation->set_rules('match_date','date','required|valid_date[y-m-d,-]');
		$this->form_validation->set_rules('match_result','match result','required|alpha');
		$this->form_validation->set_rules('your_team','your team','required|alphanumeric');
		$this->form_validation->set_rules('venue','venue','required|alphanumeric');
		$this->form_validation->set_rules('opp_team','opponent team','required|alphanumeric');
		$this->form_validation->set_rules('overs','overs','required|numeric|less_than[51]');

		$this->form_validation->set_rules('bowling_type','Bowling type','required');
		$this->form_validation->set_rules('overs_bowled','Overs bowled','required');
		$this->form_validation->set_rules('bowling_style','Bowling style','required');
		$this->form_validation->set_rules('runs_given','Runs given','required|numeric');
		$this->form_validation->set_rules('total_wickets','Total wickets','required|numeric');

		if($this->form_validation->run() == TRUE)
		{
			echo $this->save_bowling_history();
		}
		if($this->input->get('success') == 1){
			$data['message'] = "Your Bowling history saved successfully.";
			$data['title'] = "!";
			$this->load->view('message',$data);
		}
		$this->load->view('user/bowling_history');
		$this->load->view('inc/footer');
	}
	public function save_batting_history(){
		$id = $this->input->post('pro_id',TRUE);
		$count = $this->check_profile_id($this->input->post('pro_id'));
		if($count == 1){
			$match_date = preg_replace('/[a-zA-Z]/','',$this->input->post('match_date',TRUE));
			$match_result = $this->input->post('match_result',TRUE);
			$your_team = $this->input->post('your_team',TRUE);
			$venue = $this->input->post('venue',TRUE);
			$opp_team = $this->input->post('opp_team',TRUE);
			$overs = $this->input->post('overs',TRUE);
			$batting_order = $this->input->post('batting_order',TRUE);
			$batting_position = $this->input->post('batting_position',TRUE);
			$balls_faced = $this->input->post('balls_faced',TRUE);
			$runs_scored = $this->input->post('runs_scored',TRUE);
			if($runs_scored < 0){$runs_scored *= -1;}
			$_4s = $this->input->post('_4s',TRUE);
			if($_4s < 0){$_4s *= -1;}
			$_6s = $this->input->post('_6s',TRUE);
			if($_6s < 0){$_6s *= -1;}

			$sql = "INSERT INTO  `batting_history` (`Id` ,`PlayerId` ,`MyTeamName` ,`OpponentTeam` ,`MatchDate` ,`MatchVenue` ,`Overs` ,`MatchResult` ,`BattingOrder` ,`BattingPosition` ,`BallsFaced` ,`RunsScored` ,`Four` ,`Six` ,`CreateTS`) VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
			if(!$this->db->query($sql,array($id,$your_team,$opp_team,$match_date,$venue,$overs,$match_result,$batting_order,$batting_position,$balls_faced,$runs_scored,$_4s,$_6s)))
			{
				$data['message'] = "Your Batting history no saved.";
				$data['title'] = "Error !";
				$this->load->view('message',$data);
			}
			else
			{
        		redirect(current_url()."?success=1");
			}
		}else{
			$data['message'] = "You entered wrong profile Id";
			$data['title'] = "Wrong profile ID";
			echo $this->load->view('message',$data);
		}
	}
	public function save_bowling_history(){

		$id = $this->input->post('pro_id',TRUE);
		$count = $this->check_profile_id($this->input->post('pro_id'));
		if($count == 1){
			$match_date = preg_replace('/[a-zA-Z]/','',$this->input->post('match_date',TRUE));
			$match_result = $this->input->post('match_result',TRUE);
			$your_team = $this->input->post('your_team',TRUE);
			$venue = $this->input->post('venue',TRUE);
			$opp_team = $this->input->post('opp_team',TRUE);
			$overs = $this->input->post('overs',TRUE);

			$bowling_type = $this->input->post('bowling_type',TRUE);
			$overs_bowled = $this->input->post('overs_bowled',TRUE);
			$bowling_style = $this->input->post('bowling_style',TRUE);
			$runs_given = $this->input->post('runs_given',TRUE);
			$total_wickets = $this->input->post('total_wickets',TRUE);

			$sql = "INSERT INTO  `bowling_history` (`Id` ,`PlayerId` ,`MyTeamName` ,`OpponentTeam` ,`MatchDate` ,`MatchVenue` ,`Overs` ,`MatchResult` ,`BowlingType` ,`BowlingStyle` ,`OversBowled` ,`Wickets` ,`RunsGiven`,`CreateTS`) VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
			if(!$this->db->query($sql,array($id,$your_team,$opp_team,$match_date,$venue,$overs,$match_result,$bowling_type,$bowling_style,$overs_bowled,$total_wickets,$runs_given)))
			{
				$data['message'] = "Your Batting history no saved.";
				$data['title'] = "Error !";
				$this->load->view('message',$data);
			}
			else
			{
        		redirect(current_url()."?success=1");
			}
		}else{
			$data['message'] = "You entered wrong profile Id";
			$data['title'] = "Wrong profile ID";
			echo $this->load->view('message',$data);
		}
	}
	public function history(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$data['title'] = "Create/Manage history";
		$data['batting_history'] = $this->site->get_batting_history_logged_in();
		$data['bowling_history'] = $this->site->get_bowling_history_logged_in();
		$this->load->view('inc/header',$data);
		$this->load->view('user/history');
		$this->load->view('inc/footer');
	}
	
	// public function bowling_history(){
	// 	$this->users->bowling_history();
	// }
	public function bowling_style(){
		$id = $this->input->post('id');
		$data = $this->locations->get_bowling_style($id);
		$res = array();
		foreach ($data as $key) {
			$res[] = $key;
		}
		echo json_encode($res);
	}
	function del_batting(){
		$this->site->del_batting();
	}
	function del_bowling(){
		$this->site->del_bowling();
	}
	
	function send_email()
	{
		$email = $this->input->post('recover_mail',TRUE);
		$result = $this->site->check_email($email);
		$id = $result[0]['Id'];
		if($id != 0)
		{
		$subject = "Message from: www.20overs.com";
		$message = "Dear ". $this->session->userdata('name')." ,\n\n
		Here is your profile id:"  . $id.
		"\n\nIf you need further assistance please go to 20overs.com and use our contact us section to raise any concerns or to give feedback.\n\n
		Thank you for visiting 20overs.com.";
               $from = "support@20overs.com";
		$headers = "From:" . $from;
			if(mail($email,$subject,$message,$headers))
			{	
				echo "<font color='green'>Your player profile ID is sent to your email address.Please check inbox/spam folder</font>";
			}
			else
			{
				echo "<font color='red'>Error sending email</font>";
			}
		}else{
			echo "<font color='red'>Email id is wrong</font>";
		}
	}

	public function do_upload(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']  = TRUE;
		$config['file_name'] = md5($this->session->userdata('email'));

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$data['title'] = "Profile picture uploaded";
			$inserts = $this->upload->data();
			$this->load->view('inc/header',$data);
			$data['alert'] = "success";
			$data['message'] = "Image uploaded successfully. Waiting for security check<br>Image will updated after security check ";
			$filename = $inserts['file_name'];

			$this->db->where('UserSysID',$this->session->userdata('user_id'));
			if($this->db->update('20oversusers',array('image'=>$filename)))
			{
				$data['alert'] = "success";
				$data['message'] = "Profile picture uploaded successfully";
				$this->session->set_userdata('image_url',site_url()."uploads/".$filename);
			}
			else
			{
				$data['alert'] = "danger";
				$data['message'] = "Profile picture upload failed";
			}
			$this->load->view('inc/message.php',$data);
			$this->load->view('inc/footer');
			//header("Refresh:2;url=".site_url()."user/welcome");
			//$folder = "uploads/".$oldname;
			//unlink($folder);
		}
	}

	public function activate_image($user_id = null){
		if($user_id != null){
			$user_id = $cat = preg_replace("/[^0-9]+/", "", $user_id);
			if($user_id != ""){
				$this->db->where('UserSysID',$user_id);
				$this->db->update('20oversusers',array('image'=>'1'));
				redirect('/');
			}
		}
	}

	public function sendemail(){
		$this->load->library('email');
		$list = array('surya@20overs.com', 'sthaniga@20overs.com', 'cvvkshcv@20overs.com','kriskumaresh@20overs.com','jayban@20overs.com','cvvkshcv@gmail.com');
		$this->email->from("support@20overs.com","20overs");
		$this->email->to($list);

		$this->email->subject('Message from: www.20overs.com');
		$message = "<p>dsf</p><h1>SDFFSD</h1><a href='http://google.com'>Click here</a>";
		$this->email->message($message);
		$this->email->set_mailtype('html');
		if(! $this->email->send()){
			echo "fail";
		}else{
			echo "success";
		}
		//$this->email->attach($fullpath);
	}

	public function check_profile_id($id){
		$sql = "SELECT Id FROM player_profile where UserSysID = ? and Id=?";
		return $this->db->query($sql,array($this->session->userdata('user_id'),$id))->num_rows();
	}
	public function forgot_profile_id()
	{
		$data['title'] = "20overs.com - Forgot profile id";
		$this->load->view('inc/header',$data);
		$this->load->view('user/forgot_profile_id');
		$this->load->view('inc/footer');
	}
	public function upload_photo()
	{
		$data['title'] = "20overs.com - Upload photo";
		$this->load->view('inc/header',$data);
		$this->load->view('user/upload_photo');
		$this->load->view('inc/footer');
	}
}
?>