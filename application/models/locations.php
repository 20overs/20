<?php
class Locations extends CI_Model{
	public function get_countries($id=null){
		if($id==null){
			return $this->db->query('SELECT countryid,country FROM countries')->result_array();
		}else{
			return $this->db->query('SELECT countryid,country FROM countries where countryid=?',array($id))->result_array();
		}
	}
	public function get_states($id){
		return $this->db->query('SELECT stateid,name FROM states where countryid=?',array($id))->result_array();
	}
	public function get_cities($countryid,$stateid){
		return $this->db->query('SELECT id,city_name FROM cities where country_id=? AND state_id=?',array($countryid,$stateid))->result_array();
	}
	public function get_batting_style(){
		return $this->db->query('SELECT BtgStyleName as name FROM batting_styles')->result_array();
	}
	public function get_bowling_style($id=null){
		if($id===null){
			return $this->db->query('SELECT id,BwlgStyleName as name FROM bowling_styles')->result_array();
		}else{
			return $this->db->query('SELECT id,BwlgStyleName as name FROM bowling_styles where BwlgTypeId=?',array($id))->result_array();
		}
	}
	public function check_player_profile(){
		return $this->db->query('SELECT UserSysID FROM player_profile where UserSysID=?',array($this->session->userdata('user_id')))->num_rows();	
	}
}
?>