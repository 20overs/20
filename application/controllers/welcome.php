<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller 
{
	private $id_enc = 674539873;
	function __construct()
	{
		parent::__construct();
		$this->load->model('site');
	}
	public function index()
	{
		$data['title'] = "20overs.com - Home";
		$data['talent'] = $this->get_talents_today();
		$data['recent_users'] = $this->get_recent_users();
		$data['countries'] = $this->get_countries();
		$data['arti'] = $this->get_articles();
		//$data['rss'] = $this->rss();
		$this->load->view('inc/header',$data);
		$this->load->view('home/welcome_view');
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
	public function login()
	{
		$this->_check_login();
		$data['title'] = "20overs.com - Login";
		$this->load->view('inc/header',$data);
		$this->load->view('home/login');
		$this->load->view('inc/footer');
	}
	public function register()
	{
		$this->_check_login();
		$data['title'] = "20overs.com - Register";
		$this->load->view('inc/header',$data);
		$this->load->view('home/register');
		$this->load->view('inc/footer');
	}

	public function rss()
	{
		$this->load->library('curl');
		$ret = "<ul class='list-group'>";
		$result = $this->curl->simple_get('http://static.cricinfo.com/rss/livescores.xml');
		$res = new SimpleXMLElement($result);
		foreach($res->channel->item as $live){
			$ret .= "<li class='list-group-item'><b>".$live->title."</b></li>";
		}
		$ret .= "</ul>";
		return $ret;
	}

	public function _check_login()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			redirect('user/welcome');
		}
	}
	public function activate($token)
	{
		if($this->db->query('SELECT * from user_activate_account where AuthToken=?',array($token))->num_rows() > 0){
			$x = $this->db->query('SELECT UserSysID,Lastname,Firstname,Username,IDNbr,CreatedOn from user_activate_account where AuthToken=?',array($token))->row();
			if($x->UserSysID != null){
			$this->db->query('INSERT into 20oversusers(Lastname,Firstname,Username,IDNbr,CreatedOn) values(?,?,?,?,?)',array($x->Lastname,$x->Firstname,$x->Username,$x->IDNbr,$x->CreatedOn));
			$data['title'] = "Account activation";
			$this->load->view('inc/header',$data);
			if($this->db->insert_id() != null){
				$data['message'] = "<div class='jumbotron'><h2>Your account has been <span>activated successfully</span>.</h2><h2>Enjoy our <span>FREE services</span> by Creating/Maintaining <span>your own schedules in Schedules</span> and Maintain <span>your records in Talents by creating your player profile</span>.</h2></div><a href='www.20overs.com' data-toggle='modal' data-target='#login-modal' class='btn btn-primary'>Login</a>";
				$this->db->query('delete from user_activate_account where AuthToken=?',array($token));
				$this->load->view('message',$data);
			}else{
				$data['message'] = "<div class='jumbotron'><h2>Error activating your account.  Please contact support using our contact us section.</h2></div>";
				$this->load->view('message',$data);
			}
			$this->load->view('inc/footer');
			}
		}else{
			redirect('/');
		}
	}
	
	/* Database call functions */
	public function get_login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules('username', 'Username','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$errors = validation_errors();
        	echo $this->to_json($errors);
		}
		else
		{
			$this->site->get_login();
		}
	}

	public function do_register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules('username', 'Username','trim|required|valid_email|is_unique[20oversusers.Username]');
		$this->form_validation->set_rules('password','Password','trim|required|matches[re_password]|min_length[5]');
		$this->form_validation->set_rules('re_password','Re-enter password','trim|required');
		$this->form_validation->set_rules('first_name','First name','trim|required');
		$this->form_validation->set_rules('last_name','Last name','trim|required');

		$this->form_validation->set_message('is_unique', '%s is already exist. Please try another.');

		if ($this->form_validation->run() == FALSE)
		{
			$errors = validation_errors();
        	echo $this->to_json($errors);
		}
		else
		{
			$this->site->do_register();
		}
	}

	public function get_talents_today()
	{
		return ($this->site->get_talents_today());
	}
	public function get_recent_users()
	{
		return ($this->site->get_recent_users());
	}
	public function get_trending_now()
	{
		return ($this->site->get_trending_now());
	}
	public function get_what_is()
	{
		return ($this->site->get_what_is());
	}
	public function get_extras()
	{
		return ($this->site->get_extras());
	}
	public function get_googly()
	{
		return ($this->site->get_googly());
	}
	public function get_countries()
	{
		return ($this->site->get_countries());	
	}
	public function get_states()
	{
		$param = $this->input->post('country_id');
		return ($this->site->get_states($param));
	}
	public function get_cities()
	{
		$param1 = $this->input->post('country_id');
		$param2 = $this->input->post('state_id');
		return ($this->site->get_cities($param1,$param2));	
	}
	public function get_articles($param = null)
	{
		return ($this->site->get_articles($param));
	}
	public function to_json($data)
	{
		header('Content-Type: application/json');
		return json_encode($data);
	}
	public function view_profile($getid){
		if($getid == ""){
			redirect('/');
		}
		$data['title'] = "View profile";
		$this->load->view('inc/header',$data);
		$id = $getid - 674539873;
		$data['id'] = $id;
		$count = $this->site->profile_count($id);
		if($count>0){
			//$profile_id = $this->users->get_profile_id($id);
			//$data['profile_pic'] = $this->users->get_profile_pic($profile_id);
			$data['profile'] = $this->site->get_profile($id);
			// $data['name'] = $this->users->get_name($id);
			$data['batting_history'] = $this->site->get_batting_history($id);
			$data['bowling_history'] = $this->site->get_bowling_history($id);
			$data['six_four'] = $this->site->get_six_four($id);
			$data['wicket'] = $this->site->get_wicket($id);
			// $data['location'] = $this->users->pro_get_location($id);
			// $data['runs'] = $this->users->pro_get_runs($id);
			// $data['wickets'] = $this->users->pro_get_wicket($id);

			$data['user_id'] = $this->site->get_user_id($id);
			$data['profile_id'] = $getid;
			$logged_id = $this->session->userdata('pp_id');

			if($this->session->userdata('logged_in') !== FALSE && $this->session->userdata('user_id') !== $data['profile'][0]['UserSysID']){

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
}