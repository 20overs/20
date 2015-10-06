<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users');
		$this->load->model('locations');
	}
	public function get_pp_id($id){
		return $this->db->select('Id')->from('player_profile')->where('UserSysID',$id)->get()->row()->Id;
	}
	public function login(){
		$res = $this->users->login($this->input->post('username',true),$this->input->post('password',true));
		if($res !== FALSE){
			foreach ($res as $ress) {
				if($ress->image != false){
					$sessdata = array(
	                   'user_id'  => $ress->UserSysID,
	                   'user_id_enc' => $this->get_pp_id($ress->UserSysID) + 674539873,
	                   'name' => $ress->Firstname." ".$ress->Lastname,
	                   'email' =>$ress->Username,
	                   'image_url' => site_url().$ress->image_url,
	                   'admin' => $ress->admin,
	                   'logged_in' => TRUE
	             	);
				}else{
					$sessdata = array(
	                   'user_id'  => $ress->UserSysID,
	                   'user_id_enc' => $this->get_pp_id($ress->UserSysID) + 674539873,
	                   'name' => $ress->Firstname." ".$ress->Lastname,
	                   'email' =>$ress->Username,
	                   'image_url' => site_url()."uploads/talent.png",
	                   'admin' => $ress->admin,
	                   'logged_in' => TRUE
	               );
				}
				$this->session->set_userdata($sessdata);
			}
			echo "1";
		}else{
			echo "0";
		}
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
		if($check_player_profile > 0){
			$data['profile'] = $this->users->get_profile();
			$this->load->view('user/welcome_old_user',$data);
		}else{
			$this->load->view('user/welcome');
		}
		$this->load->view('inc/footer');
		$this->load->view('inc/extra_pop');
	}

	public function articles(){
		$data['title'] = "Create articles";
		$data['articles'] = $this->users->articles();
		$data['countries'] = $this->locations->get_countries();
		$this->load->view('inc/header',$data);		
		$this->load->view('user/articles');
		$this->load->view('inc/footer');
		$this->load->view('inc/extra_pop');
		$this->load->view('inc/popup');
	}
	public function add_articles(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$this->users->add_articles();
	}
	public function view_profile($getid){
		$data['title'] = "View profile";
		$this->load->view('inc/header',$data);
		$id = $getid - 674539873;
		$data['id'] = $id;
		$count = $this->users->profile_count($id);
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
	public function create_profile(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		echo $this->users->create_profile();
	}
	public function update_profile(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		echo $this->users->update_profile();
	}
	public function history(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$data['title'] = "Create/Manage history";
		$data['batting_history'] = $this->users->get_batting_history();
		$data['bowling_history'] = $this->users->get_bowling_history();
		$this->load->view('inc/header',$data);
		$this->load->view('user/history');
		$this->load->view('inc/footer');
		$this->load->view('inc/extra_pop');
	}
	public function batting_history(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$this->users->batting_history();
	}
	public function bowling_history(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$this->users->bowling_history();
	}
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
		$this->users->del_batting();
	}
	function del_bowling(){
		$this->users->del_bowling();
	}
	
	function send_email()
	{
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$email = $this->input->post('recover_mail',TRUE);
		$result = $this->users->check_email($email);
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

		//$path = $_FILES['userfile']['name'];
		//$ext = pathinfo($path, PATHINFO_EXTENSION);
		//$config['file_name'] = $this->session->userdata('email').".".$ext;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else
		{
			//$oldname = $this->db->select('image_name')->from('player_image')->where('user_id',$this->session->userdata('user_id'))->get()->row()->image_name;
			//$folder = "uploads/".$oldname;
			//unlink($folder);
			$data = array('upload_data' => $this->upload->data());
			$data['title'] = "Profile picture uploaded";
			$inserts =$this->upload->data();
			$this->load->view('inc/header',$data);
			if($this->users->do_upload($data['upload_data']['file_name'])=== TRUE){
				//$this->session->set_userdata(array('image_url'=>site_url()."uploads/".$data['upload_data']['file_name']));
				$data['alert'] = "success";
				$data['message'] = "Image uploaded successfully. Waiting for security check<br>Image will updated after security check ";
				$filename = $inserts['file_name'];
				$fileext = $inserts['file_ext'];
				$fullpath = "uploads/".$filename;

			//echo $this->db->query("select * from player_image wincache_rplist_meminfo(oid) user_id=1")->row()->num_row();
			$count = $this->db->select()->from('player_image')->where('user_id',$this->session->userdata('user_id'))->get()->num_rows();
			if($count > 0){
				//echo $this->db->select('image_url')->from('player_image')->where('user_id',$this->session->userdata('user_id'))->get()->row()->image_url;
				$this->load->helper('date');
				$this->db->where('user_id',$this->session->userdata('user_id'));
				$updatedata = array('image_name'=>$filename,'image_url'=>$fullpath,'image_ext'=>$fileext,'createTS'=>now());
				$this->db->update('player_image',$updatedata);
				$this->db->where('UserSysID',$this->session->userdata('user_id'));
				$this->db->update('20oversusers',array('image'=>'0'));
			}else{
				$insertdata = array('user_id'=>$this->session->userdata('user_id'),'image_name'=>$filename,'image_url'=>$fullpath,'image_ext'=>$fileext,'createTS'=>date('Y-m-d'));
				$this->db->insert('player_image',$insertdata);
			}

		$this->load->library('email');
		$list = array('surya@20overs.com', 'sthaniga@20overs.com', 'cvvkshcv@20overs.com','kriskumaresh@20overs.com','jayban@20overs.com');
		$this->email->from("support@20overs.com","20overs");
		$this->email->to($list);
		$user_id = $this->session->userdata('user_id');
		$user_id = $user_id + 3456;
		$message = "<h3>Image verification :</h3> \n\n <a href='http://20overs.com/test/activate_image/".$user_id."/'>Click Link</a> to activate";
		$this->email->subject('Message from: www.20overs.com');
		$this->email->message($message);
		$this->email->attach($fullpath);
		$this->email->set_mailtype('html');

		if(! $this->email->send()){
			$extra = "<br>message not sent";
		}else{
			$extra = "<br>message sent";
		}

			$this->load->view('inc/message.php',$data);
			}else{
				$data['alert'] = "danger";
				$data['message'] = "Profile picture upload failed";
				$this->load->view('inc/message.php',$data);
			}
			$this->load->view('inc/footer');
			//header("Refresh:2;url=".site_url()."user/welcome");
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
}
?>