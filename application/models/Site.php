<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* All Database logic goes here
* ID ENC - 674539873
*/
class Site extends CI_Model
{
	private $id_enc = 674539873;
	function __construct()
	{
		parent::__construct();
	}

	public function to_json($data)
	{
		header('Content-Type: application/json');
		return json_encode($data);
	}

	public function get_all_users()
	{
		return $this->db->select('*')->from('20oversusers')->get()->result();
	}

	public function get_login()
	{
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		/* Query : SELECT * FROM 20oversusers users WHERE Username=? AND AES_DECRYPT(IDNbr,'test')=? */
		$sql = $this->db->get_where('20oversusers',array('Username' => $username,'AES_DECRYPT(IDNbr,"test")' => $password));
		$count = $sql->num_rows();
		$res = $sql->result();
			if($count == 1)
			{
				$user_id = $res[0]->UserSysID;
				$sql = "select users.image,users.UserSysID,CONCAT(UCASE(users.Lastname),\" \",UCASE(users.Firstname)) as Fullname,users.Username,pp.Id as pp_id FROM 20oversusers users,player_profile pp where users.UserSysID = ? AND users.UserSysID = pp.UserSysID";
				$res = $this->db->query($sql,array($user_id))->result();
				foreach ($res as $ress)
				{
					$sessdata = array(
	                   'user_id'  => $ress->UserSysID,
	                   'pp_id' => $ress->pp_id,
	                   'pp_id_enc' => $ress->pp_id+$this->id_enc,
	                   'name' => $ress->Fullname,
	                   'email' =>$ress->Username,
	                   'image_url' => site_url().'uploads/'.$ress->image,
	                   'logged_in' => TRUE
	             	);
				}
				$this->session->set_userdata($sessdata);
				$data = array('error'=> 0 ,'message'=> 'Login success','redir'=>site_url().'user/welcome');
			}
			else
			{
				$data = array('error'=> 1,'message'=> 'Login failed');
			}
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function do_register()
	{
		/* Query : INSERT INTO user_activate_account (Lastname, Firstname, Username, IDNbr,CreatedOn,AuthToken) VALUES (?,?,?, AES_ENCRYPT(?,'test'),NOW(),?) */

		$ln = $this->input->post('last_name',TRUE);
		$fn = $this->input->post('first_name',TRUE);
		$emails = $this->input->post('username',TRUE);
		$pass = $this->input->post('password',TRUE);

		if($this->db->get_where("20oversusers",array('Username' => $emails))->num_rows() > 0)
		{
			$data = array('error'=> 1 ,'message'=> 'User already exists. Try some other.');
		}
		else
		{	
			$sql = "INSERT INTO user_activate_account (Lastname, Firstname, Username, IDNbr,CreatedOn,AuthToken) VALUES (?,?,?, AES_ENCRYPT(?,'test'),NOW(),?)";
			$token =  md5(uniqid(rand(), TRUE));
			$tokenlinkpaste = site_url()."activate/".$token;
			$res = $this->db->query($sql,array($ln,$fn,$emails,$pass,$token));
			if($res == 1)
			{
				$this->load->library('email');
				$this->email->from("support@20overs.com","20overs");
				$this->email->to($emails);
				$message = "## This is an automated response. Please do not reply to this e-mail. ##\n<br>Dear ".$fn ." 	". $ln." ,\n\n<br><br> THANK YOU for registering with us.\n\n<br><br> Click the following link to confirm your registration.\n\n<br><br>.". $tokenlinkpaste."\n\n<br><br>. If that link is not working then copy and paste this link in your browser's address bar.\n\n<br><br>.".$tokenlinkpaste." If you need further assistance please go to 20overs.com and use our contact us section to raise any concerns or to give feedback.\n\n<br><br>Thank you for visiting 20overs.com.";
				$this->email->subject(' 20Overs.com - Activate your account ');
				$this->email->message($message);
				$this->email->set_mailtype('html');
				if($this->email->send()){
					$data = array('error'=> 0 ,'message'=> 'Conformation mail has been sent to your mail.');
				}
				else
				{
					$data = array('error'=> 1 ,'message'=> 'Error sending mail.');
				}
			}
			else
			{
				$data = array('error'=> 1 ,'message'=> 'User already exists. Try some other.');
			}
		}
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_talents_today()
	{
		$sql = "SELECT CONCAT(UCASE(U.LastName),\" \",UCASE(U.FirstName)) as fullname, PF.Id,PF.DOB,PF.BattingStyle, PF.BowlingStyle, CTRY.Country, CTY.city_name FROM 20oversusers U, player_profile PF, countries CTRY, cities CTY WHERE U.UserSysID = PF.UserSysID	AND PF.Country = CTY.country_id AND PF.Country = CTRY.countryid	AND PF.State = CTY.state_id	AND PF.City = CTY.id ORDER BY RAND() LIMIT 0 , 1";
		$data = $this->db->query($sql)->result_array();
		$curryear = date('Y');
		$doby = explode("-",$data[0]["DOB"]);
		$age = $curryear-$doby[0];
		$data[0]['age'] = $age;
		$data[0]['id'] = $data[0]["Id"] + $this->id_enc;
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
		
	}

	public function get_recent_users()
	{
		$sql = "SELECT CONCAT(Firstname,' ', Lastname) AS name from 20oversusers ORDER BY UserSysID DESC LIMIT 5";
		$data = $this->db->query($sql)->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_trending_now()
	{
		$this->db->order_by('NewsPostedOn','DESC');
		$this->db->select('News');
		$data = $this->db->get_where('20overs_news',array('NewsCategory'=>'Trending Now'),3,0)->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_what_is()
	{
		$this->db->order_by('NewsPostedOn','DESC');
		$this->db->select('News');
		$data = $this->db->get_where('20overs_news',array('NewsCategory'=>'What is'),3,0)->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_extras()
	{
		$this->db->order_by('NewsPostedOn','DESC');
		$this->db->select('News');
		$data = $this->db->get_where('20overs_news',array('NewsCategory'=>'Extras'),3,0)->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_googly()
	{
		$this->db->order_by('Quiz_Id', 'RANDOM');
	    $this->db->limit(1);
	    $data = $this->db->select('Quiz_Question AS question, Quiz_Answer1 AS ans')->get('quiz')->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_countries()
	{
		$data = $this->db->select('countryid,country')->get('countries')->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_states($param)
	{
		$data = $this->db->select('stateid,name')->get_where('states',array('countryid'=>$param))->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_cities($param1,$param2)
	{
		$data = $this->db->select('id,city_name')->get_where('cities',array('country_id'=>$param1,'state_id'=>$param2))->result_array();
		if ($this->input->is_ajax_request()) 
		{
 			echo $this->to_json($data);
		}
		else
		{
			return $data;
		}
	}

	public function get_articles($id=null)
	{
		if($id==null){
			$this->db->order_by('article_id','DESC');
			return $this->db->get('20overs_articles',10)->result_array();
		}else if($id!=null){
			$this->db->order_by('article_id','DESC');
			return $this->db->get_where('20overs_articles',array('article_id',$id),10)->result_array();
		}
	}
	public function get_profile($param)
	{
		if($this->db->get_where("player_profile",array('Id' => $param))->num_rows() > 0)
		{
			$sql = 'SELECT a.UserSysID,a.image,CONCAT(UCASE(a.Firstname)," ",UCASE(a.Lastname)) as name,b.Id as pro_id,a.image,b.DOB,b.Height,b.Weight,c.country,d.name as state,e.city_name as city,b.PostalCode as postal,b.BattingStyle,b.BowlingStyle,b.IAm FROM 20oversusers a,player_profile b,countries c,states d,cities e WHERE b.id=? AND a.UserSysID = b.UserSysID AND c.id=b.Country AND d.id=b.State AND e.id = b.City';
			return $this->db->query($sql,array($param,$param,$param))->result_array();
		}
	}
	public function get_batting_history($id)
	{
		return $this->db->query("Select BH.MyTeamName,BH.BallsFaced,BH.RunsScored,BH.Four,BH.Six,BH.OpponentTeam,BH.Overs,BH.MatchDate From batting_history BH Where BH.PlayerId =?",array($id))->result_array();
	}
	public function get_bowling_history($id)
	{
		return $this->db->query("Select BLH.MyTeamName,BLH.OversBowled,BLH.Wickets,BLH.OpponentTeam,BLH.Overs,BLH.RunsGiven,BLH.MatchDate From bowling_history BLH Where BLH.PlayerId =?",array($id))->result_array();
	}
	public function get_six_four($id){
		return $this->db->query("Select sum(BH.Six) as sixes,sum(BH.Four) as fours,Sum(BH.RunsScored) as runs From batting_history BH where BH.PlayerId =?",array($id))->result_array();
	}
	public function get_wicket($id){
		return $this->db->query("Select Sum(BLH.Wickets) as wickets From bowling_history BLH Where BLH.PlayerId =?",array($id))->result_array();
	}
	public function get_profile_id($userid)
	{
		return $this->db->select('Id')->from('player_profile')->where('UserSysID',$userid)->get()->row()->Id;
	}
	public function get_user_id($profileid)
	{
		return $this->db->select('UserSysID')->from('player_profile')->where('Id',$profileid)->get()->row()->UserSysID;
	}
	public function get_location($id){
		return $this->db->query("SELECT co.Country as country, st.name as state, ct.city_name as city FROM player_profile pp ,countries co,cities ct, states st WHERE pp.Id=? and co.countryid=pp.country  and st.stateid=pp.State and st.countryid=pp.country and ct.id=pp.City and ct.state_id=pp.State and ct.country_id=pp.country",array($id))->result_array();
	}
	public function profile_count($id)
	{
		$sql = "SELECT Id from player_profile where Id =? ";
		$count = count($this->db->query($sql,array($id))->result_array());
		return $count;
	}
	public function get_profile_pic($id)
	{
		return $this->db->select('image')->from('20oversusers')->where('UserSysID',$id)->get()->row()->image;
	}
	public function get_style($id)
	{
		return $this->db->query("SELECT pp.BowlingStyle as bow,pp.BattingStyle as bat from player_profile pp where Id =? ",array($id))->result_array();
	}
	public function get_name($id)
	{
		return $this->db->query("SELECT CONCAT(UCASE(20U.Lastname),\" \",UCASE(20U.Firstname)) as fullname,Username as username FROM player_profile pp,20oversusers 20U WHERE 20U.UserSysID=pp.UserSysID AND pp.Id = ?",array($id))->result_array();
	}
	public function pro_batting_history($id){
		return $this->db->query("Select BH.MyTeamName,BH.BallsFaced,BH.RunsScored,BH.Four,BH.Six,BH.OpponentTeam,BH.Overs,BH.MatchDate From batting_history BH Where BH.PlayerId =?",array($id))->result_array();
	}
	public function pro_bowling_history($id){
		return $this->db->query("Select BLH.MyTeamName,BLH.OversBowled,BLH.Wickets,BLH.OpponentTeam,BLH.Overs,BLH.RunsGiven,BLH.MatchDate From bowling_history BLH Where BLH.PlayerId =?",array($id))->result_array();
	}
	public function pro_get_six($id){
		return $this->db->query("Select sum(BH.Six) as sixes From batting_history BH where BH.PlayerId =?",array($id))->result_array();
	}
	public function pro_get_four($id){
		return $this->db->query("Select Sum(BH.Four) as fours From batting_history BH Where BH.PlayerId =?",array($id))->result_array();
	}
	public function pro_get_runs($id){
		return $this->db->query("Select Sum(BH.RunsScored) as runs From batting_history BH Where BH.PlayerId =?",array($id))->result_array();
	}
	public function pro_get_location($id){
		return $this->db->query("SELECT co.Country as country, st.name as state, ct.city_name as city FROM player_profile pp ,countries co,cities ct, states st WHERE pp.Id=? and co.countryid=pp.country  and st.stateid=pp.State and st.countryid=pp.country and ct.id=pp.City and ct.state_id=pp.State and ct.country_id=pp.country",array($id))->result_array();
	}
	public function pro_get_wicket($id){
		return $this->db->query("Select Sum(BLH.Wickets) as wikets From bowling_history BLH Where BLH.PlayerId =?",array($id))->result_array();
	}

	/*Batting bowling history after login*/

	function get_batting_history_logged_in(){
		$sql = "SELECT a.* FROM batting_history a,player_profile b WHERE a.PlayerId=b.Id AND b.UserSysID=?";
		return $this->db->query($sql,array($this->session->userdata('user_id')))->result_array();
	}
	function get_bowling_history_logged_in(){
		$sql = "SELECT a.* FROM bowling_history a,player_profile b WHERE a.PlayerId=b.Id AND b.UserSysID=?";
		return $this->db->query($sql,array($this->session->userdata('user_id')))->result_array();
	}

	function del_batting(){
		$sql = "DELETE FROM batting_history WHERE Id=?";
		$data = array();
		if($this->db->query($sql,array($this->input->post('id')))){
			$data = array('message'=>'Batting history deleted','errors'=>0);
			echo $this->to_json($data);
		}else{
			$data = array('message'=>'Batting history is not deleted.','errors'=>1);
			echo $this->to_json($data);
		}
	}
	function del_bowling(){
		$sql = "DELETE FROM bowling_history WHERE Id=?";
		$data = array();
		if($this->db->query($sql,array($this->input->post('id')))){
			$data = array('message'=>'Bowling history deleted','errors'=>0);
			echo $this->to_json($data);
		}else{
			$data = array('message'=>'Bowling history is not deleted.','errors'=>1);
			echo $this->to_json($data);
		}
	}
	function get_profile_logged_in(){
		$sql = "SELECT a.*,b.city_name as City1,d.country as Country1,c.name as State1 FROM player_profile a,cities b,states c,countries d where UserSysID = ? and a.Country = d.countryid and (a.State = c.stateid and a.country= c.countryid) and b.id = a.City";
		return $this->db->query($sql,array($this->session->userdata('user_id')))->result_array();
	}
	function articles_logged_in(){
		$day = date("d");
		$day +=1;
		$ym = date("Y-m");
		$full = $ym."-".$day;

		$day = date("d");
		$day -=1;
		$full1 = $ym."-".$day;

		$day = date("d");
		$day +=2;
		$full2 = $ym."-".$day;

		$day = date("d");
		$full3 = $ym."-".$day;		
		$sql = "SELECT * FROM international_match_schedule where EventName = ? AND MatchType=? AND MatchStartDate IN (?,?,?,?)";
		return $this->db->query($sql,array("World Cup 2015","ODI",$full,$full1,$full2,$full3))->result_array();
	}
	function add_articles(){
		$match = $this->input->post('id',TRUE);
		$name = $this->input->post('name',TRUE);
		$arti = $this->input->post('arti',TRUE);
		$link = trim($this->input->post('link',TRUE));

		$day = date("d");
		$day +=1;
		$ym = date("Y-m");
		$full = $ym."-".$day;

		$day = date("d");
		$day -=1;
		$full1 = $ym."-".$day;

		$day = date("d");
		$day +=2;
		$full2 = $ym."-".$day;
		if($link != ""){
			$sql = "INSERT INTO 20overs_articles(user_name,match_id,article,external_link,added) VALUES(?,?,?,?,now())";
			if($this->db->query($sql,array($name,$match,$arti,$link))){
			echo "Article posted Succesfully";
			}else{
				echo "Failed to post Article";
			}
		}else{
			$sql = "INSERT INTO 20overs_articles(user_name,match_id,article,added) VALUES(?,?,?,now())";	
			if($this->db->query($sql,array($name,$match,$arti))){
			echo "Article posted Succesfully";
			}else{
				echo "Failed to post Article";
			}
		}
	}
	public function check_email($email){
		$sess_email = $this->session->userdata('email');
		if($email == $sess_email){
			$sql = "SELECT PP.Id From player_profile PP,20oversusers 20U  WHERE 20U.Username=? AND PP.UserSysID=20U.UserSysID";
			$count = $this->db->query($sql,array($sess_email))->num_rows();
			if($count > 0){
				return $this->db->query($sql,array($sess_email))->result_array();
			}else{
				return array(array('Id'=>0));
			}
		}
	}
	
	/*Social network*/
	public function friend_list()
	{
		$user_id = $this->session->userdata('pp_id');
		$sql = "SELECT F.status, CONCAT( UCASE( U.Firstname ) ,  \" \", UCASE( U.Lastname ) ) AS Name, P.Id, P.UserSysID
		FROM player_profile P, 20overs_requests F, 20oversusers U
		WHERE 
		CASE 
		WHEN F.sender_id =?
		THEN F.receiver_id = P.Id
		WHEN F.receiver_id =?
		THEN F.sender_id = P.Id
		END 
		AND F.status =  \"accepted\"
		AND P.UserSysID = U.UserSysID";
		$query = $this->db->query($sql,array($user_id,$user_id));
		$count = $query->num_rows();
		if($count > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}
	public function friend_req()
	{
		$user_id = $this->session->userdata('pp_id');
		$sql = 'SELECT F.status, CONCAT( UCASE( U.Firstname ) ,  " ", UCASE( U.Lastname ) ) AS Name, P.Id, P.UserSysID
		FROM player_profile P, 20overs_requests F, 20oversusers U
		WHERE 
		CASE 
		WHEN F.receiver_id =?
		THEN F.sender_id = P.Id
		END 
		AND F.status =  "pending"
		AND P.UserSysID = U.UserSysID';
		$query = $this->db->query($sql,array($user_id));
		$count = $query->num_rows();
		if($count > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}
	public function friend_req_sent()
	{
		$user_id = $this->session->userdata('pp_id');
		$sql = 'SELECT F.status, CONCAT( UCASE( U.Firstname ) ,  " ", UCASE( U.Lastname ) ) AS Name, P.Id, P.UserSysID
		FROM player_profile P, 20overs_requests F, 20oversusers U
		WHERE 
		CASE 
		WHEN F.receiver_id = P.Id
		THEN F.sender_id = ?
		END 
		AND F.status =  "pending"
		AND P.UserSysID = U.UserSysID';
		$query = $this->db->query($sql,array($user_id));
		$count = $query->num_rows();
		if($count > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}
}