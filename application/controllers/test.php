<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller{

	public function activate_image($user_id = null){
		if($user_id != null){
			$user_id = $cat = preg_replace("/[^0-9]+/", "", $user_id);
			if($user_id != ""){
				$user_id = $user_id - 3456;
				$this->db->where('UserSysID',$user_id);
				$this->db->update('20oversusers',array('image'=>'1'));
				//$sql = "UPDATE 20oversusers SET image='1' WHERE UserSysID=?";
				//$this->db->query($sql,array($user_id));
				redirect('/');
			}
		}
	}
	public function test1(){
		$this->load->library('curl');
		$result = $this->curl->simple_get('http://static.cricinfo.com/rss/livescores.xml');
		$res = new SimpleXMLElement($result);
		foreach($res->channel->item as $live){
			echo "<p style='text-transform:upper-case;'>".$live->title . "</p>";
		}
	}

}