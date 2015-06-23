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
				$sessdata = array(
                   'user_id'  => $ress->UserSysID,
                   'user_id_enc' => $ress->UserSysID + 674539873,
                   'name' => $ress->Firstname." ".$ress->Lastname,
                   'email' =>$ress->Username,
                   'logged_in' => TRUE
               );
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
	
	function send_email(){
		$email = $this->input->post('recover_mail',TRUE);
	}
}
?>