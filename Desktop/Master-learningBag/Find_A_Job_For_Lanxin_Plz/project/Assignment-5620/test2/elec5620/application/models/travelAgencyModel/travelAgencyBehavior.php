<?php

class TravelAgencyBehavior extends CI_Model
{
	public function checkWhetherExist($data)
	{
		$agencyName=$data['agencyName'];
		$userName=$data['accountName'];

		$query = $this->db->select('accountName')->from('agencyaccount')->where('agencyName',$agencyName)->get();
		foreach ($query->result_array() as $row)
		{
			if($row['accountName'] ==$userName )
				{
					return true;
				}
		}
		return false;
	}
	public function registerTA($data)
	{
		$exist=$this->checkWhetherExist($data);
		//echo $exist;
		if($exist)
		{
			echo "<script>alert('Existed UserAccount')</script>";
			return false;
		}
		else
		{
			$this->db->insert('agencyaccount', $data);
			echo "<script>alert('Register successfully')</script>";
			return true;
		}
	}
	public function tALogin($data)
	{
		$agencyName=$data['agencyName'];
		$userName=$data['accountName'];
		$password=$data['password'];
		$query = $this->db->where(array('agencyName'=>$agencyName,'accountname'=>$userName ))->get('agencyaccount')->result_array();
		foreach ($query as $row)
		{
			if(password_verify((string)$password, (string)$row['password']))
			{
				return true;
			}
		}
		return false;
	}
	public function recordPandA($data)
	{
		$this->db->insert('tasecurity', $data);
	}
	public function addItinerary($data)
	{
		$this->db->insert('itinerary', $data);
	}
	public function checkAns($ans)
	{
		$agencyName=$ans['agencyName'];
		$userName=$ans['userName'];
		$ans1=$ans['answer1'];
		$ans2=$ans['answer2'];

		$query = $this->db->where(array('agencyName'=>$agencyName,'userName'=>$userName ))->get('tasecurity');
		foreach ($query->result_array() as $row)
		{
			if($row['answer1'] ==$ans1&& $row['answer2'] ==$ans2 )
			{
				return true;
			}
		}
		return false;
	}
	public function getSecurityProblem($ans)
	{
		$agencyName=$ans['agencyName'];
		$userName=$ans['userName'];

		//$query = $this->db->select('problem1','problem2')->from('taSecurity')->where('userName',$userName)->where('agencyName',$agencyName)->get();
		$query = $this->db->where(array('agencyName'=>$agencyName,'userName'=>$userName ))->get('tasecurity')->result_array();
		return $query;
	}
	public function updateNewPassword($data)
	{
		$agencyName=$data['agencyName'];
		$userName=$data['userName'];
		$newPassword=array(
			'password'=>$data['newPassword']
		);

		//$this->db->update('agencyaccount',$newPassword)->where('accountName',$userName)->where('agencyName',$agencyName);
		$this->db->update('agencyaccount', $newPassword,array('agencyName'=>$agencyName,'accountName'=>$userName));
	}
	public function getAllItineraries($agencyInformation)
	{
		$agencyName=$agencyInformation['agencyName'];
		$result=$this->db->where('agencyName',$agencyName)->get('itinerary')->result_Array();
		return $result;
	}
	public function getItineraryByID($data)
	{
		$result=$this->db->where($data)->get('itinerary')->result_Array();
		return $result;
	}
	public function getCompanyInform($data)
	{
		$agencyName=$data['agencyName'];
		$result=$this->db->where('agencyName',$agencyName)->get('agencyinform')->result_Array();
		return $result;
	}
	public function editCompanyInfo($data)
	{
		$agencyName=$data['agencyName'];

		$query = $this->db->where(array('agencyName'=>$agencyName))->get('agencyinform')->result_array();
		if(count($query)==0)
		{
			$this->db->insert('agencyinform', $data);
		}
		else {
			$this->db->update('agencyinform', $data,array('agencyName'=>$agencyName));
		}
	}
	public function searchItinerary($placeName,$agencyName)
	{
		$query=$this->db->where(array('agencyName'=>$agencyName))->query("SELECT * FROM itinerary WHERE title like '%$placeName%'");
		return $query->result_Array();
	}
	public function editItinerary($data,$id)
	{
		$this->db->update('itinerary', $data,array('itineraryID'=>$id));
		//$this->db->update('itinerary',$data)->where('itineraryID',$id);
	}
	public function deleteItineraryById($id)
	{
		$data=array(
			'itineraryID'=>$id
		);
		$this->db->delete('itinerary',$data);
	}
	public function addAdvertisement($data)
	{
		$query = $this->db->where(array('agencyName'=>$data['agencyName'],'pid'=>$data['pid']))->get('taadvertising')->result_array();
		if(count($query)==0)
		{
			$this->db->insert('taadvertising', $data);
			return true;
		}
		else
		{
			return false;
		}

	}
	public function getAdvertisement($pid)
	{
		$query1 = $this->db->where(array('pID'=>$pid))->get('taadvertising')->result_array();
		$return_array=array();
		if(count($query1)!=0)
		{
			foreach($query1 as $agency)
			{
				$query2=$this->db->where(array('agencyName'=>$agency['agencyName']))->get('itinerary')->result_array();
				array_push($return_array,$query2);
			}
			return $return_array;

		}
		else
		{
			$data=array();
			return $data;
		}

	}
}

