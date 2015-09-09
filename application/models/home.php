<?php
class Home extends CI_Model{
	function get_matches(){
		$today = date("Y-m-d");
		return $this->db->query('SELECT * FROM  international_match_schedule where MatchStartDate=?',array($today))->result_array();
	}
	function get_articles($id = null){
		if($id==null){
			return $this->db->query('SELECT * FROM 	20overs_articles order by article_id desc limit 10')->result_array();
		}else if($id!=null){
			return $this->db->query('SELECT * FROM 	20overs_articles where article_id=? limit 1',array($id))->result_array();
		}
		
	}
	function talent(){
		$sql = "SELECT CONCAT(UCASE(U.LastName),\" \",UCASE(U.FirstName)) as fullname, PF.Id,PF.DOB,PF.BattingStyle, PF.BowlingStyle, CTRY.Country, CTY.city_name FROM 20oversusers U, player_profile PF, countries CTRY, cities CTY WHERE U.UserSysID = PF.UserSysID	AND PF.Country = CTY.country_id AND PF.Country = CTRY.countryid	AND PF.State = CTY.state_id	AND PF.City = CTY.id ORDER BY RAND() LIMIT 0 , 1";
		return $this->db->query($sql)->result_array();
	}
	function recent(){
		$sql = "SELECT Firstname from 20oversusers ORDER BY UserSysID DESC LIMIT 5";
		return $this->db->query($sql)->result_array();
	}
	function quiz(){
		$sql = "SELECT Quiz_Question AS qq, Quiz_Answer1 AS qa1, Quiz_Answer2 AS qa2, Quiz_Answer3 AS qa3, Quiz_Answer4 AS qa4 FROM quiz as Q1 JOIN (SELECT (RAND() * (SELECT MAX(Quiz_Id ) FROM quiz)) AS id) AS Q2 WHERE Q1.Quiz_Id >= Q2.id ORDER BY Q1.Quiz_Id ASC LIMIT 1";
		return $this->db->query($sql)->result_array();
	}
	function news($cat=null){
		$sql = "SELECT News as news FROM 20overs_news WHERE NewsCategory = ? ORDER BY NewsPostedOn DESC LIMIT 3 ";
		return $this->db->query($sql,array($cat))->result_array();
	}

	/*
	function register($email,$first,$last,$pass){
		$sql = "SELECT Username FROM 20oversusers WHERE Username=?";
		$count = $this->db->query($sql,array($email))->num_rows();
		if($count < 1)
		{
			$sql = "INSERT INTO user_activate_account (Lastname, Firstname, Username, IDNbr,CreatedOn,AuthToken) VALUES (?,?,?, AES_ENCRYPT(?,'test'),NOW(),?)";
			$token =  md5(uniqid(rand(), TRUE));
			$tokenlinkpaste = site_url()."welcome/active/".$token;
			if ($this->db->query($sql,array($last,$first,$email,$pass,$token)))
			{
				$toemail = $email;
				$to = trim($toemail);
				$subject = "20Overs.com - Activate your account";
				$message =" ## This is an automated response. Please do not reply to this e-mail. ##\n\n
						Dear ". $last." ,\n\n
						THANK YOU for registering with us.\n\n Click the following link to confirm your registration.\n\n.". $tokenlinkpaste."
						\n\n. If that link is not working then copy and paste this link in your browser's address bar.\n\n.".$tokenlinkpaste." If you need further assistance please go to 20overs.com and use our contact us section to raise any concerns or to give feedback.\n\n
						Thank you for visiting 20overs.com.";
				$from = "support@20overs.com";
				$headers = "From:" . $from;
				if(mail($to,$subject,$message,$headers))
				{	
					return "<font color='green'>Activation link has been sent to your Email Id . Follow the instructions in email to activate your account</font>";
				}
				else
				{
					return "Error sending email";
				}
			}else{
				return "Error saving your data";
			}
		}else{
			return 'User already exist';
		}
	}
	*/
	function register($emails,$first,$last,$pass)
	{
		header('Content-Type: application/json');
		$sql = "SELECT Username FROM 20oversusers WHERE Username=?";
		$count = $this->db->query($sql,array($emails))->num_rows();
		if($count > 0)
		{
			echo json_encode(array('error' => 1,'message'=>"<font color='red'>There is already an account with this email address!!  Please try with different email address.</font>"));
		}
		else
		{
			$sql = "INSERT INTO user_activate_account (Lastname, Firstname, Username, IDNbr,CreatedOn,AuthToken) VALUES (?,?,?, AES_ENCRYPT(?,'test'),NOW(),?)";
			$token =  md5(uniqid(rand(), TRUE));
			$tokenlinkpaste = site_url()."welcome/active/".$token;
			if ($this->db->query($sql,array($last,$first,$emails,$pass,$token)))
			{
				$this->load->library('email');
				$this->email->from("support@20overs.com","20overs");
				$this->email->to($emails);
				$message = "## This is an automated response. Please do not reply to this e-mail. ##\n<br>Dear ".$first ." 	". $last." ,\n\n<br><br> THANK YOU for registering with us.\n\n<br><br> Click the following link to confirm your registration.\n\n<br><br>.". $tokenlinkpaste."\n\n<br><br>. If that link is not working then copy and paste this link in your browser's address bar.\n\n<br><br>.".$tokenlinkpaste." If you need further assistance please go to 20overs.com and use our contact us section to raise any concerns or to give feedback.\n\n<br><br>Thank you for visiting 20overs.com.";
				$this->email->subject('20Overs.com - Activate your account');
				$this->email->message($message);
				$this->email->set_mailtype('html');
				if($this->email->send()){
					echo json_encode(array('error' => 0,'message'=>"<font color='green'>Confirmation mail has sent to your mail.</font>"));
				}else{
					echo json_encode(array('error' => 1,'message'=>"<font color='red'>Error saving your data.</font>"));
				}
			}else{
				echo json_encode(array('error' => 1,'message'=>"<font color='red'>Error saving your data.</font>"));
			}
		}
	}	
}