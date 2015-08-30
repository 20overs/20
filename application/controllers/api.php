<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends CI_Controller{

	public function index()
	{
		$sql = "SELECT Team1Name,Team2Name FROM international_match_schedule LIMIT 1";
		echo json_encode($this->db->query($sql)->result_array());
	}
}