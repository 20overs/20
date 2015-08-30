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
		$sql = "SELECT * FROM 20oversusers users WHERE Username=? AND AES_DECRYPT(IDNbr,'test')=?";
		$image = $this->db->query($sql,array('cvvkshcv@gmail.com','cvvkshcv'))->result();
		echo $image[0]->image;
	}

}