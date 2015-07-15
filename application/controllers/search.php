<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$bowlbatstyle = $this->input->post('bowlbatstyle');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$postalcode = $this->input->post('zipcode');
		/*$sql1="SELECT co.country from Countries co where co.countryid='$country'";
		$sql2="SELECT st.name as state from States st , Player_Profile pp where st.stateid='$state' and st.countryid ='$country' ";
		$sql3="SELECT ct.city_name as city from Cities ct , Player_Profile pp where  ct.id='$city' and  ct.state_id='$state' and ct.country_id='$country'";*/
		if(!empty($country)&& ($state) && ($city) && ($postalcode))
		{
		$sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.name as State,ct.city_name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=?  and pp.Country=? and pp.State=? and pp.City=? and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=?  and pp.Country=? and pp.State=? and pp.City=? and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$country,$state,$city,$postalcode,$bowlbatstyle,$country,$state,$city,$postalcode))->result_array();
			
		}


		else if(!empty($country)&&  ($city) && ($postalcode))
		{
		 $sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.city_name as State,ct.name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=?  and pp.Country=? and pp.City=? and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=?  and pp.Country=? and pp.City=? and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$country,$city,$postalcode,$bowlbatstyle,$country,$city,$postalcode))->result_array();
		}
		else if(!empty($country)&&  ($city))
		{
		 $sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.name as State,ct.city_name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=?  and pp.Country=? and pp.City=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=?  and pp.Country=? and pp.City=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";

		$res = $this->db->query($sql,array($bowlbatstyle,$country,$city,$bowlbatstyle,$country,$city))->result_array();

		}
		else if(!empty($country)&&   ($postalcode))
		{
		 $sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.name as State,ct.city_name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=?  and pp.Country=?  and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=?  and pp.Country=? and  pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$country,$postalcode,$bowlbatstyle,$country,$postalcode))->result_array();
		}


		else if(!empty($country)&& ($state) && ($city))
		{

		 $sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.name as State,ct.city_name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=? and pp.Country=? and pp.State=? and pp.City=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=? and pp.Country=? and pp.State=? and pp.City=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$country,$state,$city,$bowlbatstyle,$country,$state,$city,$postalcode))->result_array();
		}
		else if(!empty($country)&& ($state))
		{

		 $sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.name as State,ct.city_name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=?  and pp.Country=? and pp.State=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=?  and pp.Country=? and pp.State=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$country,$state,$bowlbatstyle,$country,$state))->result_array();
		}
		else if(!empty($country))
		{

		 $sql = "SELECT pp.Id,pp.UserSysID,pp.DOB,pp.Country,st.name as State,ct.city_name as City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=? and pp.Country=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=? and pp.Country=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$country,$bowlbatstyle,$country))->result_array();
		}
		else if(!empty($postalcode))
		{

		 $sql = "SELECT pp.Id,pp.UserSysID,pp.Id,pp.DOB,st.name as State,ct.city_name as City,pp.City,pp.PostalCode,pp.BattingStyle,pp.BowlingStyle,co.country,CONCAT(UCASE(20U.LastName),\" \",UCASE(20U.FirstName)) as fullname
		FROM
		Player_Profile pp,
		Countries co,
		Cities ct,
		States st,
		20oversUsers 20U
		where
		pp.BattingStyle=? and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID
		or
		pp.BowlingStyle=? and pp.PostalCode=?
		and
		co.countryid=pp.Country
		and
		ct.id=pp.City
		and ct.state_id =pp.State and ct.country_id=pp.Country and
		st.stateid=pp.State
		AND st.countryid = pp.Country
		and
		20U.UserSysID=pp.UserSysID";
		$res = $this->db->query($sql,array($bowlbatstyle,$postalcode,$bowlbatstyle,$postalcode))->result_array();
		}
		if(count($res) > 0){
			$curryear = date('Y');
			foreach ($res as $row) {
				$doby = explode("-",$row["DOB"]);
				$age = $curryear-$doby[0];
				$id=	$row['Id']+674539873;
				$data['data'][] =array('id' => $id,'userid'=>$row['UserSysID'],'dob'=>$row['DOB'],'country'=>$row['country'],'state'=>$row['State'],'city'=>$row['City'],'postal'=>$row['PostalCode'],'battingstyle'=>$row['BattingStyle'],'bowlingstyle'=>$row['BowlingStyle'],'fullname'=>$row['fullname'],'age'=>$age);				
			}
			$this->load->view('search',$data);
		}else{
			echo "No result found";
		}
	}
}