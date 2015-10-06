<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social extends CI_Controller{
	private $data;
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('/');
		}
		$this->data['title'] = "20overs | Social";
	}
	public function index(){
		$this->load->view('social/inc/header',$this->data);
		$this->load->view('social/social');
		$this->load->view('social/inc/footer');
	}
}