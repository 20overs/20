<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->model('home');
		$this->load->model('locations');
		$data['countries'] = $this->locations->get_countries();
		$data['title'] = "20overs.com";
		$data['arti'] = $this->home->get_articles();
		$data['arti_count'] = count($data['arti']);
		$data['talent'] = $this->home->talent();
		$data['recent'] = $this->home->recent();
		$data['quiz'] = $this->home->quiz();
		$data['whatis'] = $this->home->news('What is');
		$data['trending'] = $this->home->news('Trending Now');
		$data['extras'] = $this->home->news('Extras');
		$this->load->view('inc/header',$data);
		$this->load->view('home/welcome_view');
		$this->load->view('home/welcome_row_1');
		$this->load->view('home/welcome_row_2');
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
	public function profile(){
		$data['title'] = "Player Profile";
		$this->load->view('inc/header',$data);
		$this->load->view('home/profile');
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
}