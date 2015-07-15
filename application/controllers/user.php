<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('users');
		$this->load->model('locations');
	}
	public function login(){
		$res = $this->users->login($this->input->post('username',true),$this->input->post('password',true));
		if($res !== FALSE){
			foreach ($res as $ress) {
				if($ress->image != ""){
					$sessdata = array(
	                   'user_id'  => $ress->UserSysID,
	                   'user_id_enc' => $ress->UserSysID + 674539873,
	                   'name' => $ress->Firstname." ".$ress->Lastname,
	                   'email' =>$ress->Username,
	                   'image_url' => site_url()."uploads/".$ress->image,
	                   'logged_in' => TRUE
	               );
				}else{
					$sessdata = array(
	                   'user_id'  => $ress->UserSysID,
	                   'user_id_enc' => $ress->UserSysID + 674539873,
	                   'name' => $ress->Firstname." ".$ress->Lastname,
	                   'email' =>$ress->Username,
	                   'image_url' => site_url()."uploads/talent.jpg",
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
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$data['title'] = "Create articles";
		$data['articles'] = $this->users->articles();
		$this->load->view('inc/header',$data);
		$this->load->view('user/articles');
		$this->load->view('inc/footer');
		$this->load->view('inc/extra_pop');
	}
	public function add_articles(){
		if($this->session->userdata('logged_in')!==TRUE){
			redirect('/');
			die();
		}
		$this->users->add_articles();
	}
	public function view_profile($id){
		$data['title'] = "View profile";
		$this->load->view('inc/header',$data);

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

		$path = $_FILES['userfile']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$config['file_name'] = $this->session->userdata('email').".".$ext;

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
			$insert=$this->upload->data();
			$this->load->view('inc/header',$data);
			if($this->users->do_upload($data['upload_data']['file_name'])=== TRUE){
				$this->session->set_userdata(array('image_url'=>site_url()."uploads/".$data['upload_data']['file_name']));
				$data['alert'] = "success";
				$data['message'] = "Profile photo uploaded successfully";
				$this->load->view('inc/message.php',$data);
			}else{
				$data['alert'] = "danger";
				$data['message'] = "Profile picture upload failed";
				$this->load->view('inc/message.php',$data);
			}
			$this->load->view('inc/footer');
			header("Refresh:2;url=".site_url()."user/welcome");
		}
	}

	public function doreset(){
		echo "A";
	}

}
?>