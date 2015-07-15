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
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
	public function profile(){
		$data['title'] = "Player Profile";
		$this->load->view('inc/header',$data);
		$this->load->view('home/profile');
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
		$this->load->view('inc/extra_pop');
	}
	public function register(){
		$email = $this->input->post('email',TRUE);
		$first = $this->input->post('reg-first-name',TRUE);
		$last = $this->input->post('reg-last-name',TRUE);
		$pass = $this->input->post('reg-password',TRUE);
		$this->load->model('home');
		$res = $this->home->register($email,$first,$last,$pass);
		echo $res;
	}
	public function recover(){
		$email = $this->input->post('lostpassword',TRUE);
		$passtoken =  md5(uniqid(rand(),TRUE));
		$resetlinkpaste = site_url()."welcome/reset/".$passtoken;
		$this->session->set_userdata('resetcode',$passtoken);
		$this->session->set_userdata('timestamp1',time());
		$sql = "SELECT Firstname, Lastname from 20oversusers where Username=? ";
		$count = $this->db->query($sql,array($email))->num_rows();
		if($count > 0){
			$res = $this->db->query($sql,array($email))->result_array();
			$fullname = $res[0]['Firstname']." ".$res[0]['Lastname'];
			$to = trim($email);
			$this->session->set_userdata('retemailid',$to);
		$subject = "Message from 20overs.com - Password Reset Link";
		$message =" ## This is an automated response. Please do not reply to this e-mail. ##\n\n
			Dear ". $fullname." ,\n
          	You are receiving this email because a request has been submitted to change your password. If you have requested additional password changes the following link will no longer be valid.\n\nPlease use the link in the most recent email to change your password. It will expire in 5 minutes.\nUse the following link to change your password. It will expire in 5 minutes.\n".$resetlinkpaste."\r\n "
			."\n\n\n## This is an automated response. Please do not reply to this e-mail.##\n\n\nThank you for visiting 20overs.com - 20overs.com Support Team";
		$from = "support@20overs.com";
		$headers = "From:" . $from;
			if(mail($to,$subject,$message,$headers))
			{
				echo "<font color='green'>The password reset link is sent to email address.</font>";
			}
			else
			{
				echo "Error sending email";
			}
		}else{
				echo"<font color='red'>You have entered an incorrect email!!</font>";
		}
	}
	public function reset($id){
		if($id == ""){
			redirect('/');
		}
		$this->load->model('home');
		$data['title'] = "Reset password";
		$this->session->set_userdata('token',$id);
		$this->load->view('inc/header',$data);
		$this->load->view('reset');
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
	public function doreset(){
		$data['title'] = "Reset password";
		$this->load->view('inc/header',$data);
		$token = $this->session->userdata('token');
		$resetcode = $this->session->userdata('resetcode');
		$timestamp = $this->session->userdata('timestamp1');
		$username = $this->session->userdata('retemailid');
		$pass1 =  $this->input->post('pass');
		$pass2 =  $this->input->post('repass');
		if((time() - $timestamp) <= 300)
			{
				if(isset($token))
					{
						if($pass1==$pass2)
						{
						$datas=$pass1;
						if($token==$resetcode)
						{
							$sql = "SELECT AES_DECRYPT(IDNbr,'test') as IdNbr from 20oversusers where Username=?";
							$res = $this->db->query($sql,array($username))->result_array();
							$oldpass = $res[0]['IdNbr'];
							if($datas==$oldpass)
							{
								$data['alert'] = "danger";
								$data['message'] = "<font color='red'>Old password and new password are same.</font>";
							}
							else 
							{
								$sql="UPDATE 20oversusers set IDNbr=AES_ENCRYPT(?,'test') where Username=?";
								$this->db->query($sql,array($datas,$username));
								$data['alert'] = "success";
								$data['message'] = "<font color='green'>Your password changed successfully.</font>";
							}
						}
						else
						{
							$data['alert'] = "danger";
							$data['message'] = "<font color='red'>The link has been expired. Please try again.</font>";
						}
						}
						else
						{
							$data['alert'] = "danger";
							$data['message'] = "<font color='red'>Passwords do not match.</font>";
							
						}
			}
		}		
		else 
		{
			$data['alert'] = "danger";
			$data['message'] = "<font color='red'>The link has been expired. Please try again.</font>";
		}
		$this->load->view('inc/message',$data);
		$this->load->view('inc/footer');
		$this->load->view('inc/popup');
	}
	
}