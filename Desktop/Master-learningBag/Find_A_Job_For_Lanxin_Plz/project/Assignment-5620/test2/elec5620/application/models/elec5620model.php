<?php

class elec5620model extends CI_Model
{

	public function first_query()
	{
		$query = $this->db->query('SELECT * FROM useraccount');
		return $query->result();
	}
	public function simple_insert($username,$pw,$phone,$email,$ques,$ans,$type){
		//Query
		$data=array(

			'username'=>$username,
			'password'=>$pw,
			'phone'=>$phone,
			'email'=>$email,
			'secret_ques'=>$ques,
			'answer'=>$ans,
			'type'=>$type,
		);
		$this->db->insert('useraccount',$data);

	}
	public function finduser ($username){
		//$query=$this->db->query("SELECT * FROM useraccount WHERE username= '$username'"); //find row
		//return $query->result();
		//echo $query->result()->answer;
		$query = $this->db->get_where('useraccount', array('username'=>$username));
		return $query->row_array();
	}
	public function finduser_email ($email){
		$query = $this->db->get_where('useraccount', array('email'=>$email));
		return $query->row_array();

	}
	public function edit_password($username,$password){
		$data = array(
			'password' => $password,
		);
		$this->db->where('username', $username);
		$this->db->update('useraccount', $data);

	}
	public function edit_user($username,$phone,$email,$question,$answer){
		$data = array(

			'phone' => $phone,
			'email' => $email,
			'secret_ques' => $question,
			'answer' => $answer,
		);

		$this->db->where('username', $username);
		$this->db->update('useraccount', $data);
	}
	public function update_balance($username,$amount){
		$data = array(
			'balance' => $amount,
		);
		$this->db->where('username', $username);
		$this->db->update('useraccount', $data);

	}
	public function upload_picture($uid,$creatorName,$description,$name,$upload_time,$address){
		$data=array(
			'creatorName'=>$creatorName,
			'uid'=>$uid,
			'description'=>$description,
			'name'=>$name,
			'upload_time'=>$upload_time,
			'address'=>$address,
			'viewTimes'=>0,

		);
		$this->db->insert('pictures',$data);

	}

	public function all_picture(){
		$query = $this->db->query('SELECT * FROM pictures');
		return $query->result();
	}


	public function search_picture($pid){
		$query = $this->db->get_where('pictures', array('pid'=>$pid));
		return $query->row_array();

	}
	public function add_comment ($pid,$username,$comment,$rate,$time){
		$data=array(

			'pid'=>$pid,
			'username'=>$username,
			'comment'=>$comment,
			'rate'=>$rate,
			'time'=>$time);

		$this->db->insert('comment',$data);
	}
	public function show_comment($pid){
		$query = $this->db->query("SELECT * FROM comment WHERE pid='$pid'"  );
		return $query->result();
	}
	public function search($keyword){
		$query=$this->db->query("SELECT * FROM pictures WHERE name like '%$keyword%'");
		return $query->result();

	}
	public function update_viewTime($pid,$viewTimes){
		$data = array(
			'viewTimes' =>$viewTimes+1 ,
		);
		$this->db->where('pid', $pid);
		$this->db->update('pictures', $data);
	}

	public function findMostPopView()
	{
		//$query = $this->db->query('SELECT * FROM pictures');
		$this->db->from('pictures');
		$this->db->order_by('viewTimes', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function findUserInfo()
	{
		$query = $this->db->query("SELECT * FROM useraccount where type ='user'");
		return $query->result();
	}
	public function deleteUser($name){
		$this->db->where('username', $name);
		$this->db->delete('useraccount');

	}
}
?>
