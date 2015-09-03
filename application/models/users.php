<?php
class Users extends CI_Model{
		
	function login($user,$pass){
		$sql = "SELECT * FROM 20oversusers users WHERE Username=? AND AES_DECRYPT(IDNbr,'test')=?";
		//$sql = "SELECT users.*,pi.image_url FROM 20oversusers users,player_image pi WHERE Username=? AND AES_DECRYPT(IDNbr,'test')=?";
		if($this->db->query($sql,array($user,$pass))->num_rows() === 1){

			$sql = "SELECT * FROM 20oversusers users WHERE Username=? AND AES_DECRYPT(IDNbr,'test')=?";
			$datas = $this->db->query($sql,array($user,$pass))->result();

			$image = $datas[0]->image;
			$user_id = $datas[0]->UserSysID;
			if($image == 1){
				$sql = "SELECT users.*,pi.image_url FROM 20oversusers users,player_image pi WHERE users.Username=? AND AES_DECRYPT(IDNbr,'test')=? AND pi.user_id=?";
				return $this->db->query($sql,array($user,$pass,$user_id))->result();
			}else{
				$sql = "SELECT * FROM 20oversusers users WHERE Username=? AND AES_DECRYPT(IDNbr,'test')=?";
				return $this->db->query($sql,array($user,$pass))->result();
			}
		}else{
			return FALSE;
		}
	}

	function create_profile(){
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
		$sql = "INSERT INTO  `player_profile` (`Id` ,`UserSysID` ,`DOB` ,`Height` ,`Weight` ,`Country` ,`State` ,`City` ,`PostalCode` ,`BattingStyle` ,`BowlingStyle` ,`DoYouKeepWicket` ,`HaveYouCaptained` ,`Disclosure`,`IAm` ,`PlayerOrgBy` ,`PlayerOrgName` ,`CreateTS`) VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
		$this->db->query($sql,array($this->session->userdata('user_id'),$dob,$height,$weight,$country,$state,$city,$postal,$batting,$bowling,$wicket,$captained,$agree,$iam,$iamfrom,$orgname));
		$id = $this->db->insert_id();
		$this->db->trans_complete();
		return json_encode(array('message'=>$id));
		}else{
			echo "<center>You dont have access to this page</center>";
		}
	}
	
	function update_profile(){
		if($this->input->post('batting')){
		$dob=preg_replace('/[a-zA-Z]/','',$this->input->post('dob',TRUE));
		$height = $this->input->post('height',TRUE);
		if($height < 0){
			$height *= -1;
		}
		$weight = $this->input->post('weight',TRUE);
		if($weight < 0){
			$weight *= -1;
		}
		$country = $this->input->post('country',TRUE);
		$state = $this->input->post('state',TRUE);
		$city = $this->input->post('city',TRUE);
		$postal = $this->input->post('postal',TRUE);
		if($postal < 0){
			$postal *= -1;
		}
		$batting = $this->input->post('batting',TRUE);
		$bowling = $this->input->post('bowling',TRUE);
		$wicket = $this->input->post('wicket',TRUE);
		$captained = $this->input->post('captained',TRUE);
		$iamfrom =$this->input->post('iamfrom',TRUE);
		$iam = $this->input->post('iam',TRUE);
		$orgname = $this->input->post('orgname',TRUE);
		$agree = $this->input->post('agree',TRUE);
		$sql = "UPDATE  `player_profile` SET `DOB` = ?,`Height`=? ,`Weight`=?,`Country`=? ,`State`=? ,`City`=? ,`PostalCode`=? ,`BattingStyle`=? ,`BowlingStyle`=? ,`DoYouKeepWicket`=? ,`HaveYouCaptained`=? ,`Disclosure`=?,`IAm`=? ,`PlayerOrgBy`=? ,`PlayerOrgName`=? WHERE `UserSysID`=?";
		$this->db->query($sql,array($dob,$height,$weight,$country,$state,$city,$postal,$batting,$bowling,$wicket,$captained,$agree,$iam,$iamfrom,$orgname,$this->session->userdata('user_id')));
		return json_encode(array('message'=>'Successfully player profile updated.'));
		}
	}
	function get_profile(){
		$sql = "SELECT a.*,b.city_name as City1,d.country as Country1,c.name as State1 FROM player_profile a,cities b,states c,countries d where UserSysID = ? and a.Country = d.countryid and (a.State = c.stateid and a.country= c.countryid) and b.id = a.City";
		return $this->db->query($sql,array($this->session->userdata('user_id')))->result_array();
	}
	public function check_profile_id($id){
		$sql = "SELECT Id FROM player_profile where UserSysID = ? and Id=?";
		return $this->db->query($sql,array($this->session->userdata('user_id'),$id))->num_rows();
	}
	public function batting_history(){
		$count = $this->check_profile_id($this->input->post('id'));
		if($count == 1){
			$id = $this->input->post('id',TRUE);
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
			$this->db->query($sql,array($id,$your_team,$opp_team,$match_date,$venue,$overs,$match_result,$batting_order,$batting_position,$balls_faced,$runs_scored,$_4s,$_6s));
			echo json_encode(array('message'=>'Batting history saved','errors'=>0));
			
		}else{
			echo json_encode(array('message'=>'Wrong Profile ID.','errors'=>1));
		}
	}
	public function bowling_history(){
		$count = $this->check_profile_id($this->input->post('id'));
		if($count == 1){
			$id = $this->input->post('id',TRUE);
			$match_date = preg_replace('/[a-zA-Z]/','',$this->input->post('match_date',TRUE));
			$match_result = $this->input->post('match_result',TRUE);
			$your_team = $this->input->post('your_team',TRUE);
			$venue = $this->input->post('venue',TRUE);
			$opp_team = $this->input->post('opp_team',TRUE);
			$overs = $this->input->post('overs',TRUE);
			$overs_bowled = $this->input->post('overs_bowled',TRUE);
			$bowling_type = $this->input->post('bowling_type',TRUE);
			$bowling_style = $this->input->post('bowling_style',TRUE);
			$total_wickets = $this->input->post('total_wickets',TRUE);
			$runs_given = $this->input->post('runs_given',TRUE);
			if($runs_given < 0){$runs_given *= -1;}
			if($total_wickets < 0){$total_wickets *= -1;}
			if($total_wickets > 10){$total_wickets = 0;}
			if($runs_given < 0){$runs_given *= -1;}
			$sql = "INSERT INTO  `bowling_history` (`Id` ,`PlayerId` ,`MyTeamName` ,`OpponentTeam` ,`MatchDate` ,`MatchVenue` ,`Overs` ,`MatchResult` ,`BowlingType` ,`BowlingStyle` ,`OversBowled` ,`Wickets` ,`RunsGiven` ,`CreateTS`) VALUES (NULL , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
			$this->db->query($sql,array($id,$your_team,$opp_team,$match_date,$venue,$overs,$match_result,$bowling_type,$bowling_style,$overs_bowled,$total_wickets,$runs_given));
			echo json_encode(array('message'=>'Bowling history saved','errors'=>0));
			
		}else{
			echo json_encode(array('message'=>'Wrong Profile ID.','errors'=>1));
		}
	}

	function get_batting_history(){
		$sql = "SELECT a.* FROM batting_history a,player_profile b WHERE a.PlayerId=b.Id AND b.UserSysID=?";
		return $this->db->query($sql,array($this->session->userdata('user_id')))->result_array();
	}
	function get_bowling_history(){
		$sql = "SELECT a.* FROM bowling_history a,player_profile b WHERE a.PlayerId=b.Id AND b.UserSysID=?";
		return $this->db->query($sql,array($this->session->userdata('user_id')))->result_array();
	}
	function del_batting(){
		$sql = "DELETE FROM batting_history WHERE Id=?";
		if($this->db->query($sql,array($this->input->post('id')))){
			echo json_encode(array('message'=>'Batting history deleted','errors'=>0));
		}else{
			echo json_encode(array('message'=>'Batting history not deleted.','errors'=>1));
		}
	}
	function del_bowling(){
		$sql = "DELETE FROM bowling_history WHERE Id=?";
		if($this->db->query($sql,array($this->input->post('id')))){
			echo json_encode(array('message'=>'Batting history deleted','errors'=>0));
		}else{
			echo json_encode(array('message'=>'Batting history not deleted.','errors'=>1));
		}
	}

	function articles(){
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
	public function do_upload($ext){
		$sql = "UPDATE 20oversusers SET image=? WHERE UserSysID=?";
		if($this->db->query($sql,array($ext,$this->session->userdata('user_id'))))
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function profile_count($id){
		$sql = "SELECT Id from player_profile where Id =? ";
		$count = count($this->db->query($sql,array($id))->result_array());
		return $count;
	}

	public function get_style($id){
		return $this->db->query("SELECT pp.BowlingStyle as bow,pp.BattingStyle as bat from player_profile pp where Id =? ",array($id))->result_array();
	}
	public function get_name($id){
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
	public function get_profile_pic($id){
		$user = $this->db->select('UserSysID')->from('player_profile')->where('Id',$id)->get()->row();
		$id = $this->db->select('image')->from('20oversusers')->where('UserSysID',$user->UserSysID)->get()->row();
		$image = $id->image;
		if($image == 0){
			return 'uploads/talent.jpg';
		}else{
			return $this->db->select('image_url')->from('player_image')->where('user_id',$id)->get()->row()->image_url;
		}
	}
}
?>