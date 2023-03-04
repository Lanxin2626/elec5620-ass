<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mycontroller extends CI_Controller
{
	public function index()
	{
		if (!isset($_SESSION['user'])) {
			$this->load->view('loginform');
		} else {
			$this->main_page();
		}
	}


	public function login($yzm)
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$this->load->helper('form');
		$this->load->helper('url');
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$security = $this->input->post('entercode');
		$this->load->helper('url');
		$results = $this->elec5620model->first_query();
		$type = "";
		$flag = 'false';

		if (!isset($_SESSION)) {
			$this->session->sess_expiration = '0';// expires in 4 hours
			$this->session->sess_expire_on_close = FALSE;
			session_start();

		}
		//if (!isset($_SESSION['user'])) {

		foreach ($results as $result) {
			if ($username == $result->username && password_verify($password, $result->password) && $security == $yzm) {
				$data['username'] = $username;
				$user = $_POST['username'];
				$pw = $_POST['password'];
				$type = $result->type;

				if (isset($_POST['rem'])) {
					if ($_POST['rem']) {
						setcookie("username", $user, time() + 3600, '/');
						setcookie("password", $pw, time() + 3600, '/');

						//echo '1';
					} else {
						setcookie("username", '', time() - 3600, '/');
						setcookie("password", '', time() - 3600, '/');
					}
				} else {
					setcookie("username", '', time() - 3600, '/');
					setcookie("password", '', time() - 3600, '/');
				}
				$_SESSION['user'] = $user;
				$_SESSION['pw'] = $pw;
				$_SESSION["login_time"] = time();
				$_SESSION["type"] = $type;
				//$_SESSION['UserSelect']=$this->elec5620model->finduser ($_SESSION['user']);
				//$_SESSION['amount']=$UserSelect['balance'];
				//$_SESSION['test'] = 'testSesstion';
				$flag = 'true';
				echo "";
				$this->load->view('login_success', $data);
				break;
			}

		}
		if ($flag == 'false') {
			$this->load->view('login_failure');
		}
		//} else {

		//$this->load->view('main_page');
		//	}

	}

	public function Register()
	{
		$this->load->view("register_page");
	}

	public function Register_admin()
	{

		$this->load->view("register_page_admin");
	}

	public function Register_agency()
	{

		$this->load->view("register_page_agency");
	}

	public function Signup()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$username = $this->input->post('username');
		$pw = $this->input->post('pwd');
		$hash = password_hash($pw, PASSWORD_DEFAULT);
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$ques = $this->input->post('question');
		$ans = $this->input->post('answer');
		$data['nam'] = $username;
		if ($username != Null && $pw != Null && $phone != Null && $email != Null && $ques != Null && $ans != Null) {
			$check = $this->elec5620model->finduser($username);
			$checkemail = $this->elec5620model->finduser_email($email);
			if ($check != null) {
				$this->load->view('reg_username_exist');
			} else if ($checkemail != null) {
				$this->load->view('reg_email_exist');
			} else if ($check == null && $checkemail == null) {
				//user, admin, agency
				$this->elec5620model->simple_insert($username, $hash, $phone, $email, $ques, $ans, "user");
				$this->load->view('reg_success', $data);
			}
		} else {
			$this->load->view('reg_null');
		}
	}

	public function Signup_admin()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$username = $this->input->post('username');
		$pw = $this->input->post('pwd');
		$hash = password_hash($pw, PASSWORD_DEFAULT);
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$ques = $this->input->post('question');
		$ans = $this->input->post('answer');
		$data['nam'] = $username;
		if ($username != Null && $pw != Null && $phone != Null && $email != Null && $ques != Null && $ans != Null) {
			$check = $this->elec5620model->finduser($username);
			$checkemail = $this->elec5620model->finduser_email($email);
			if ($check != null) {
				$this->load->view('reg_username_exist');
			} else if ($checkemail != null) {
				$this->load->view('reg_email_exist');
			} else if ($check == null && $checkemail == null) {
				//user, admin, agency
				$this->elec5620model->simple_insert($username, $hash, $phone, $email, $ques, $ans, "admin");
				$this->load->view('reg_success', $data);
			}
		} else {
			$this->load->view('reg_null');
		}
	}

	public function Signup_agency()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$username = $this->input->post('username');
		$pw = $this->input->post('pwd');
		$hash = password_hash($pw, PASSWORD_DEFAULT);
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$ques = $this->input->post('question');
		$ans = $this->input->post('answer');
		$data['nam'] = $username;
		if ($username != Null && $pw != Null && $phone != Null && $email != Null && $ques != Null && $ans != Null) {
			$check = $this->elec5620model->finduser($username);
			$checkemail = $this->elec5620model->finduser_email($email);
			if ($check != null) {
				$this->load->view('reg_username_exist');
			} else if ($checkemail != null) {
				$this->load->view('reg_email_exist');
			} else if ($check == null && $checkemail == null) {
				//user, admin, agency
				$this->elec5620model->simple_insert($username, $hash, $phone, $email, $ques, $ans, "agency");
				$this->load->view('reg_success', $data);
			}
		} else {
			$this->load->view('reg_null');
		}
	}

	public function forgetPasswordPage()
	{
		$this->load->view('forgetPasswordPage');
	}

	public function forgetPassword()
	{

		$this->load->database();
		$this->load->model('elec5620model');


		$username = $this->input->post("username");//user input
		$result = $this->elec5620model->finduser($username);//database

		if ($result) { //if match or not; return one array

			$data['row'] = $result;

			$this->load->view('enter_answer', $data);
		} else {
			$this->load->view('UsernameNotExist');;
		}
	}

	public function check_answer($ans, $username)
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$password = $this->input->post('pwd');
		$answer = $this->input->post('ans');
		$hash = password_hash($password, PASSWORD_DEFAULT);
		if ($ans == $answer) {

			if ($password != Null) {
				$this->elec5620model->edit_password($username, $hash);
				$this->load->view('password_changed');

			} else {
				$this->load->view('forget_password_null');

			}

		} else {
			$this->load->view('forget_password_wrong');
		}
	}

	public function main_page()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$data['results'] = $this->elec5620model->all_picture();
		$this->load->view('main_page', $data);
	}

	public function search()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$keyword = $this->input->post('keyword');
		$data['results'] = $this->elec5620model->search($keyword);
		$this->load->view('search_view', $data);

	}

	public function findMostPopView()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$data['results'] = $this->elec5620model->findMostPopView();
		$this->load->view('popularViews', $data);
	}

	public function logout()
	{
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		$this->load->view('loginform');
		echo "<h4><strong>You have logout successfully!</strong></h4>";
	}

	public function enterGcpFrame()
	{
		$this->load->view('GcpFrame');
	}

	public function test()
	{

		$this->load->database();
		$this->load->model('elec5620model');
		$user = $this->elec5620model->finduser($_SESSION['user']);
		$amount_now = $user['balance'];


		$config['upload_path'] = './feed/';
		$config['allowed_types'] = 'jpeg|jpg|png|apng|bmp|tif';
		$config['max_size'] = '5000'; // max_size in kb
		$config['file_name'] = $_FILES['image']['name'];
		//$src=base_url('uploads/').$_FILES['image']['name'];
		$data["path"] = base_url('feed/') . str_replace(" ", '', ($_FILES['image']['name']));
		$_SESSION['path'] = $data["path"];
		$this->load->library('upload', $config);
		if($_FILES['image']['name']==null||$_FILES['image']['name']==""){
			$this->enterGcpFrame();
		}
		else{
			if ($amount_now - 2 >= 0) {
				$this->elec5620model->update_balance($_SESSION['user'], $amount_now - 2);

				if ($this->upload->do_upload('image')) {
					$this->load->view('test', $data);
				}
			} else {
				$this->load->view('insuffcient_Amount');
			}
		}

	}

	public function GoogleLocation($location)
	{
		$data["location"] = $location;
		$this->load->view("location5620", $data);
	}

	public function editPortfolioPage()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$data['userInfo'] = $this->elec5620model->finduser($_SESSION['user']);
		$this->load->view('editPortfolioPage', $data);

	}

	public function edituserfile()
	{

		$this->load->database();
		$this->load->model('elec5620model');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$question = $this->input->post('question');
		$answer = $this->input->post('answer');
		$username = $_SESSION['user'];
		if($phone==""||$email==""||$question==""||$answer==""){
			$this->editPortfolioPage();
		}
		else{
			$this->elec5620model->edit_user($username, $phone, $email, $question, $answer);
			$this->load->view("success_edit");
		}

	}

	public function topUpPage()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$data['balance'] = $this->elec5620model->finduser($_SESSION['user']);

		$this->load->view('topUpPage', $data);

	}

	public function topUpPage1()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$amount = $this->input->post('amount');

		$num = $this->input->post('num');
		$name = $this->input->post('name');
		$exp = $this->input->post('exp');
		$cvv = $this->input->post('cvv');

		$user = $this->elec5620model->finduser($_SESSION['user']);
		$amount_now = $user['balance'];
		if ($amount != null && $num != null && $name != null && $exp != null && $cvv != null) {
			$this->elec5620model->update_balance($_SESSION['user'], $amount + $amount_now);
			$this->topUpPage();
		} else {
			$this->topUpPage();
		}

	}

	public function uploadPicture($location)
	{


		$data["path"] = $_SESSION['path'];
		//echo $data["path"];
		$data["location"] = $location;

		$this->load->view("uploadPicture", $data);


	}

	public function uploadPictureToDatabase()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$results = $this->elec5620model->finduser($_SESSION['user']);
		$uid = $results["uid"];
		$name = $this->input->post('name');
		$des = $this->input->post('des');
		$address = $_SESSION['path'];
		$time = date("Y-m-d H:i:s", time()) . "";
		$creatorName = $_SESSION['user'];
		if ($name && $des != null) {
			$this->elec5620model->upload_picture($uid, $creatorName, $des, $name, $time, $address);
			unset($_SESSION['path']);
			$this->load->view("upload_success");
		} else {
			$this->load->view("upload_fail");
		}

	}

	public function viewPicturePage($pid)
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$result = $this->elec5620model->search_picture($pid);
		$this->elec5620model->update_viewTime($pid, $result["viewTimes"]);
		$data["creatorName"] = $result["creatorName"];
		$data["description"] = $result["description"];
		$data["name"] = $result["name"];
		$data["upload_time"] = $result["upload_time"];
		$data["address"] = $result["address"];
		$data["pid"] = $pid;
		$results = $this->elec5620model->show_comment($pid);
		$data['results'] = $results;
		// travel agency advertisement Part
		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$advertisements = $this->travelAgencyBehavior->getAdvertisement($pid);
		$data['advertisements'] = $advertisements;
		//send information to page
		//print_r($data);
		$this->load->view("picturePage", $data);

	}

	public function updateViewRateAndComment($pid)
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$comment = $this->input->post('comment');
		$rate = $this->input->post('rate');
		$username = $_SESSION['user'];
		$time = date("Y-m-d H:i:s", time()) . "";
		$this->elec5620model->add_comment($pid, $username, $comment, floatval($rate), $time);//return float value
		$this->viewPicturePage($pid);


	}

	public function viewUserList()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$results = $this->elec5620model->findUserInfo();
		$data['results'] = $results;
		$this->load->view("viewUserList", $data);

	}

	public function delete($name)
	{
		$this->load->database();
		$this->load->model('elec5620model');

		$this->elec5620model->deleteUser($name);
		$this->viewUserList();

	}

	public function search_ajax()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$keyword = $this->input->get('keyword');
		$results = $this->elec5620model->search($keyword);
		$response = '<ul class="list-group"> ';
		foreach ($results as $result) {
			$name = $result->name;
			$response = $response . '<li class="list-group-item">' . $name . '</li>';

		}
		$response = $response . '</ul>';
		echo $response;
	}
}
