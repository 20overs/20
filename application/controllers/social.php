<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social extends CI_Controller{
	private $data;
	public function __construct(){
		parent::__construct();
		$this->load->model('site');
		if(!$this->session->userdata('logged_in'))
		{
			if($this->input->is_ajax_request())
			{
				echo $this->_json("0","Please Login");
				die();
			}
			else
			{
				redirect('/');
			}
		}
		$this->data['title'] = "20overs.com - Social";
		$this->data['notification_count'] = $this->site->notification_count();
		$this->data['friend_request_count'] = $this->site->friend_request_count();

		$this->output->set_header("HTTP/1.0 200 OK");
		$this->output->set_header("HTTP/1.1 200 OK");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}

	public function index(){
		$from = $this->session->userdata('pp_id');
		$this->data['title'] = "20overs.com - Friend Request list";
		$this->data['friend_list'] = $this->site->friend_list();
		$this->data['friend_req'] = $this->site->friend_req();

		$this->load->view('inc/header',$this->data);
		$this->load->view('user/view_social_request');
		$this->load->view('inc/footer');
	}
	
	private function _json($success,$message,$opt=""){
		if($opt !== "")
		{
			return json_encode(array('success' => $success,'message'=>$message,'opt'=>$opt));
		}
		else
		{
			return json_encode(array('success' => $success,'message'=>$message));
		}
	}

	public function _request_type($in){
		switch ($in) {
			case 0:
				return 'friend';
			break;
			case 1:
				return 'join_team';
			break;
			case 2:
				return 'created_team';
			break;
			default:
				return 'friend';
			break;
		}
	}
	public function _request_status($in){
		switch ($in) {
			case 0:
				return 'pending';
			break;
			case 1:
				return 'accepted';
			break;
			case 2:
				return 'rejected';
			break;
			case 3:
				return 'blocked';
			break;
			case 4:
				return 'cancelled';
			break;
			case 5:
				return 'unfriend';
			break;
			default:
				return 'pending';
			break;
		}
	}
	public function user_exist($id)
	{
		return $this->db->query('SELECT count(*) as nums FROM player_profile where Id=?',array($id))->row()->nums;
	}
	public function _pro_id($id){
		return $id > 674539873 ? ($id - 674539873) : ($id + 674539873);
	}
	public function request()
	{
		header('Content-Type: application/json');
		if($this->input->post("to",TRUE) == "" || $this->input->post("status",TRUE) =="" || $this->input->post("type",TRUE)== "")
		{
			echo $this->_json("0","Something went wrong");
		}
		else
		{	
			$from = $this->session->userdata('pp_id');
			$to = $this->_pro_id($this->input->post("to",TRUE));
			$status = $this->_request_status($this->input->post("status",TRUE));
			$type = $this->_request_type($this->input->post("type",TRUE));
			if($from !== "" && $to !=="" && $type !== "" && $status !="")
			{
				switch ($type) {
					case 'friend':
						if($status == 'pending')
						{
							$counts = $this->db->query('SELECT count(*) as nums FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and (status="pending" or status="accepted")',array($from,$from,$to,$to))->row()->nums;
							$usercount = $this->user_exist($from);
							$this->db->query('DELETE FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and status="rejected"',array($from,$from,$to,$to));
							if($counts > 0 || $usercount < 1){
								echo $this->_json("0","You already have a friend request from this user. Please refresh page.");
							}
							else
							{
								if($this->db->query("INSERT into 20overs_requests(sender_id,receiver_id,status,request_type) values(?,?,?,?)",array($from,$to,$status,$type)))
								{
									echo $this->_json("1","Friend request sent !",$this->_pro_id($to));
									$this->notification($type,$to,$from,'pending');
								}
								else
								{
									echo $this->_json("0","Error sending request !");
								}
							}
						}
						else if($status == 'rejected')
						{
							$counts = $this->db->query('SELECT count(*) as nums FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and (status="rejected")',array($from,$from,$to,$to))->row()->nums;
							$usercount = $this->user_exist($from);
							if($counts > 0 || $usercount < 1){
								echo $this->_json("0","Error cancelling friends.");
							}
							else
							{
								if($this->db->query('update 20overs_requests set status="rejected" where sender_id=? and receiver_id=?',array($from,$to)))
								{
									echo $this->_json("1","Request cancelled.",$this->_pro_id($to));
								}
								else
								{
									echo $this->_json("0","Error cancelling friends.");
								}
							}
						}
						else if($status == 'accepted')
						{
							$counts = $this->db->query('SELECT count(*) as nums FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and (status="accepted")',array($from,$from,$to,$to))->row()->nums;
							$usercount = $this->user_exist($from);
							if($counts > 0 || $usercount < 1){
								echo $this->_json("0","Error accepting friend request.");
							}
							else
							{
								if($this->db->query('UPDATE 20overs_requests SET status="accepted" WHERE (sender_id=? or receiver_id=?) AND (sender_id=? or receiver_id=?) AND (status="pending")',array($from,$from,$to,$to)))
								{
									//$this->db->query('DELETE FROM 20overs_requests where sender_id=? and receiver_id=?',array($to,$from));
									echo $this->_json("1","Request accepted.",$this->_pro_id($to));
									$this->notification($type,$to,$from,'accepted');
								}
								else
								{
									echo $this->_json("0","Error accepting friend request.");
								}
							}
						}
						else if($status == 'cancelled')
						{
							$counts = $this->db->query('SELECT count(*) as nums FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and (status="pending")',array($from,$from,$to,$to))->row()->nums;
							$usercount = $this->user_exist($from);
							if($counts == 0 || $usercount < 1)
							{
								echo $this->_json("0","Error while cancelling your friend request. Please refresh the page.");
							}
							else
							{
								if($this->db->query('DELETE FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and status="pending"',array($from,$from,$to,$to)))
								{
									echo $this->_json("1","Friend request cancelled.");
									$this->notification($type,$to,$from,'',1);
								}
								else
								{
									echo $this->_json("0","Friend request cancel failed.");
								}
							}
						}
						else if($status == 'unfriend')
						{
							$counts = $this->db->query('SELECT count(*) as nums FROM 20overs_requests where (sender_id=? or receiver_id=?) and (sender_id=? or receiver_id=?) and (status="accepted")',array($from,$from,$to,$to))->row()->nums;
							$usercount = $this->user_exist($from);
							if($counts < 1 || $usercount < 1){
								echo $this->_json("0","Error while trying to unfriend. Please refresh the page.");
							}
							else
							{
								if($this->db->query('UPDATE 20overs_requests SET status="rejected" WHERE (sender_id=? or receiver_id=?) AND (sender_id=? or receiver_id=?) AND (status="accepted")',array($from,$from,$to,$to)))
								{
									//$this->db->query('DELETE FROM 20overs_requests where sender_id=? and receiver_id=?',array($to,$from));
									echo $this->_json("1","You unfriended.",$this->_pro_id($to));
								}
								else
								{
									echo $this->_json("0","Error while trying to unfriend.");
								}
							}
						}
					break;

					case 'join_team':
					
					break;

					default:

					break;
				}
			}
			else
			{
				echo $this->_json("0","Something went wrong. Try again later.");
			}
		}
	}
	public function notification($type,$to_id,$from_id,$status,$delete=FALSE)
	{
		if($delete == FALSE)
		{
			$this->db->query("insert into 20overs_notification(type,status,to_id,from_id) values(?,?,?,?)",array($type,$status,$to_id,$from_id));
		}
		else
		{
			$this->db->query("delete from 20overs_notification where type=? AND to_id=? AND from_id=? and status='pending'",array($type,$to_id,$from_id));
		}
	}
	public function notification_list()
	{
		$from = $this->session->userdata('pp_id');
		$this->data['title'] = "20overs.com - Notifications";
		$this->data['notification_list'] = $this->get_notification();
		$this->data['old_notification_list'] = $this->get_old_notification();
		$this->load->view('inc/header',$this->data);
		$this->load->view('user/view_social_notifications');
		$this->load->view('inc/footer');
	}
	public function get_notification($last_id = FALSE)
	{
		if($last_id == FALSE)
		{
			return $this->site->notification_list();
		}
		else
		{
			$this->output->set_header("Content-Type: application/json");
			echo json_encode($this->site->notification_list($last_id));
		}
	}
	public function get_old_notification()
	{
		return $this->site->old_notification_list();
	}
}