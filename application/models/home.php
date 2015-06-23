<?php
class Home extends CI_Model{
	function get_articles($id = null){
		if($id==null){
			return $this->db->query('SELECT * FROM 	20overs_articles order by article_id desc limit 10')->result_array();
		}else if($id!=null){
			return $this->db->query('SELECT * FROM 	20overs_articles where article_id=? limit 1',array($id))->result_array();
		}
		
	}
	function talent(){
		$sql = "SELECT CONCAT(UCASE(U.LastName),\" \",UCASE(U.FirstName)) as fullname, PF.Id,PF.DOB,PF.BattingStyle, PF.BowlingStyle, CTRY.Country, CTY.city_name FROM 20oversUsers U, Player_Profile PF, Countries CTRY, Cities CTY WHERE U.UserSysID = PF.UserSysID	AND PF.Country = CTY.country_id AND PF.Country = CTRY.countryid	AND PF.State = CTY.state_id	AND PF.City = CTY.id ORDER BY RAND() LIMIT 0 , 1";
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
}