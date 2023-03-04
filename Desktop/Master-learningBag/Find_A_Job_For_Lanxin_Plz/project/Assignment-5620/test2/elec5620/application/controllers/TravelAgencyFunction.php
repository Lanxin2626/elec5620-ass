<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TravelAgencyFunction extends CI_Controller
{
	public function index()
	{
		//echo '1546';
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('travelAgencyView/login');
	}

	public function registerForm()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('travelAgencyView/register');
	}

	public function register()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();

		$this->form_validation->set_rules('agencyName', 'Agency Name', 'required');
		$this->form_validation->set_rules('userName', 'User Name', 'required');
		$this->form_validation->set_rules('eMail', 'E-Mail', 'required');
		$this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required');
		$this->form_validation->set_rules('password', 'Pass Word', 'required');
		$this->form_validation->set_rules('cPassword', 'Check PassWord', 'required');
		$status = $this->form_validation->run();
		if ($status) {
			if ($_POST['password'] == $_POST['cPassword']) {
				$this->load->model('travelAgencyModel/travelAgencyBehavior');
				$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$data1 = array(
					'agencyName' => $_POST['agencyName'],
					'accountName' => $_POST['userName'],
					'password' => $hash,
					'email' => $_POST['eMail'],
					'phone' => $_POST['phoneNumber']
				);
				$data2 = array(
					'agencyName' => $_POST['agencyName'],
					'accountName' => $_POST['userName'],
					'password' => $_POST['password']
				);
				if ($this->travelAgencyBehavior->registerTA($data1)) {
					//$this->load->view('travelAgencyView/logIn');
					$this->session->set_userdata('registerInfo', $data2);
					$this->load->view('travelAgencyView/agencyPWSecurity');
				} else {
					$this->load->view('travelAgencyView/register');
				}

			} else {
				echo "<script>alert('Password Not Same')</script>";
				$this->load->view('travelAgencyView/register');
			}
		} else {
			$this->load->view('travelAgencyView/register');
		}

		//redirect(site_url('TravelAgencyFunction/register'));
	}

	public function login()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();


		$this->form_validation->set_rules('agencyName', 'Agency Name', 'required');
		$this->form_validation->set_rules('userName', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Pass Word', 'required');
		$status = $this->form_validation->run();
		if ($status) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$data = array(
				'agencyName' => $_POST['agencyName'],
				'accountName' => $_POST['userName'],
				'password' => (string)$_POST['password']

			);
			if ($this->travelAgencyBehavior->tALogin($data)) {
				$this->session->set_userData('userInfo', $data);
				$this->showCompanyInform();
				//$this->load->view('travelAgencyView/companyInform');
			} else {
				echo "<script>alert('Wrong User Name or Password')</script>";
				$this->load->view('travelAgencyView/logIn');
			}
		} else {
			$this->load->view('travelAgencyView/logIn');
		}
	}

	public function securityProtectionAdd()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();

		$this->form_validation->set_rules('problem1', 'problem1', 'required');
		$this->form_validation->set_rules('answer1', 'answer1', 'required');
		$this->form_validation->set_rules('problem2', 'problem2', 'required');
		$this->form_validation->set_rules('answer2', 'answer2', 'required');
		$status = $this->form_validation->run();

		if ($status) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$registerInfo = $this->session->userdata('registerInfo');
			$data = array(
				'agencyName' => $registerInfo['agencyName'],
				'userName' => $registerInfo['accountName'],
				'problem1' => $_POST['problem1'],
				'answer1' => $_POST['answer1'],
				'problem2' => $_POST['problem2'],
				'answer2' => $_POST['answer2']
			);
			$this->travelAgencyBehavior->recordPandA($data);
			$this->load->view('travelAgencyView/logIn');
		} else {
			$this->load->view('travelAgencyView/agencyPWSecurity');
		}
	}

	public function itineraryAddPage()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();
		$this->load->view('travelAgencyView/addNew_Itinerary');
	}

	public function itineraryAdd()
	{
		//CompanyImage-Upload
		$config['upload_path'] = 'uploads/itineraryImage';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10000;
		$config['file_name'] = time() . mt_rand();
		$this->load->library('upload', $config);
		$statusImage = $this->upload->do_upload('coverPicture');
		//if(!$statusImage){
		//echo "<script>alert('You must upload the company picture')</script>";
		//die;
		//}
		$wrong = $this->upload->display_errors();
		if ($wrong) {
			//print_r($wrong);
			//die;
		}
		$info = $this->upload->data();
		//print_r($info);
		//small picture
		$arr['source_image'] = $info['full_path'];
		$arr['create_thumb'] = FALSE;
		$arr['maintain_ratio'] = TRUE;
		$arr['width'] = 200;
		$arr['height'] = 200;
		$this->load->library('image_lib', $arr);
		$this->image_lib->resize();

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('placeStart', 'placeStart', 'required');
		$this->form_validation->set_rules('placeEnd', 'placeEnd', 'required');
		$this->form_validation->set_rules('duration', 'duration', 'required');
		$this->form_validation->set_rules('introductionItinerary', 'introductionItinerary', 'required');
		$this->form_validation->set_rules('itineraryPrice', 'itineraryPrice', 'required');
		$status = $this->form_validation->run();

		if ($status) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$userInfo = $this->session->userdata('userInfo');
			$data = array(
				'agencyName' => $userInfo['agencyName'],
				'userName' => $userInfo['accountName'],
				'title' => $_POST['title'],
				'placeStart' => $_POST['placeStart'],
				'placeEnd' => $_POST['placeEnd'],
				'duration' => $_POST['duration'],
				'coverPicture' => $info['file_name'],
				'introduction' => $_POST['introductionItinerary'],
				'price' => $_POST['itineraryPrice']
			);
			//$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$this->travelAgencyBehavior->addItinerary($data);
			echo "<script>alert('add successfully')</script>";
			//$this->load->view('travelAgencyView/currentItinerary');
			$this->showItinerary();
		} else {
			$this->load->view('travelAgencyView/addNew_Itinerary');
		}
	}

	public function itineraryEditPage()
	{
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');

		$itineraryID = $this->uri->segment(3);
		$data = array(
			'itineraryID' => $itineraryID
		);
		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$result['itineraryInfo'] = $this->travelAgencyBehavior->getItineraryByID($data);
		$this->load->view('travelAgencyView/edit_Itinerary', $result);
	}

	public function itineraryEdit()
	{
		//CompanyImage-Upload
		$config['upload_path'] = 'uploads/itineraryImage';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10000;
		$config['file_name'] = time() . mt_rand();
		$this->load->library('upload', $config);
		$statusImage = $this->upload->do_upload('coverPicture');
		//if(!$statusImage){
		//echo "<script>alert('You must upload the company picture')</script>";
		//die;
		//}
		$wrong = $this->upload->display_errors();
		if ($wrong) {
			//print_r($wrong);
			//die;
		}
		$info = $this->upload->data();
		//print_r($info);
		//small picture
		$arr['source_image'] = $info['full_path'];
		$arr['create_thumb'] = FALSE;
		$arr['maintain_ratio'] = TRUE;
		$arr['width'] = 200;
		$arr['height'] = 200;
		$this->load->library('image_lib', $arr);
		$this->image_lib->resize();

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('placeStart', 'placeStart', 'required');
		$this->form_validation->set_rules('placeEnd', 'placeEnd', 'required');
		$this->form_validation->set_rules('duration', 'duration', 'required');
		//$this->form_validation->set_rules('coverPicture','coverPicture','required');
		$this->form_validation->set_rules('itinerary_introduction', 'introductionItinerary', 'required');
		$this->form_validation->set_rules('itinerary_price', 'itineraryPrice', 'required');
		$status = $this->form_validation->run();

		if ($status && $statusImage) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$userInfo = $this->session->userdata('userInfo');
			$data = array(
				'agencyName' => $userInfo['agencyName'],
				'userName' => $userInfo['accountName'],
				'title' => $_POST['title'],
				'placeStart' => $_POST['placeStart'],
				'placeEnd' => $_POST['placeEnd'],
				'duration' => $_POST['duration'],
				'coverPicture' => $info['file_name'],
				'introduction' => $_POST['itinerary_introduction'],
				'price' => $_POST['itinerary_price']
			);
			//$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$this->travelAgencyBehavior->editItinerary($data, $_POST['itineraryID']);
			echo "<script>alert('Edit successfully')</script>";
			$this->showItineraryDetail($_POST['itineraryID']);
			//$this->load->view('travelAgencyView/itinerary_Detail');
		} else if ($status && (!$statusImage)) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$userInfo = $this->session->userdata('userInfo');
			$data = array(
				'agencyName' => $userInfo['agencyName'],
				'userName' => $userInfo['accountName'],
				'title' => $_POST['title'],
				'placeStart' => $_POST['placeStart'],
				'placeEnd' => $_POST['placeEnd'],
				'duration' => $_POST['duration'],
				//'coverPicture' =>$info['file_name'],
				'introduction' => $_POST['itinerary_introduction'],
				'price' => $_POST['itinerary_price']
			);
			//$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$this->travelAgencyBehavior->editItinerary($data, $_POST['itineraryID']);
			echo "<script>alert('Edit successfully')</script>";
			$this->showItineraryDetail($_POST['itineraryID']);
			//$this->load->view('travelAgencyView/itinerary_Detail');
		} else {
			echo "<script>alert('Something wrong')</script>";
			$this->showItinerary();

		}
	}

	public function showItineraryDetail($id)
	{
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$data = array(
			'itineraryID' => $id
		);

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$result['itineraryInfo'] = $this->travelAgencyBehavior->getItineraryByID($data);
		$this->load->view('travelAgencyView/edit_Itinerary', $result);

	}

	public function showItineraryToClient($id)
	{
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
		$data = array(
			'itineraryID' => $id
		);

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$result['itineraryInfo'] = $this->travelAgencyBehavior->getItineraryByID($data);
		$this->load->view('travelAgencyView/itinerary_Detail', $result);

	}

	public function deleteItinerary()
	{
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$itineraryID = $this->uri->segment(3);
		$this->travelAgencyBehavior->deleteItineraryById($itineraryID);
		echo "<script>alert('Delete successfully')</script>";
		//$this->load->view('travelAgencyView/currentItinerary');
		$this->showItinerary();
	}

	public function showItinerary()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		//$this->load->library('form_validation');
		$this->load->database();

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$userInfo = $this->session->userdata('userInfo');
		$data = array(
			'agencyName' => $userInfo['agencyName']
			//'userName'=>$userInfo['userName']
		);
		$result['allItinerary'] = $this->travelAgencyBehavior->getAllItineraries($data);
		//print_r(($result));
		$this->load->view('travelAgencyView/current_Itineraries', $result);
	}

	public function showCompanyInform()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		//$this->load->library('form_validation');
		$this->load->database();

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$userInfo = $this->session->userdata('userInfo');
		$data = array(
			'agencyName' => $userInfo['agencyName']
		);
		$result1 = $this->travelAgencyBehavior->getCompanyInform($data);
		if (count($result1) == 0) {
			$result['companyInfo'] = array(
				'agencyName' => $userInfo['agencyName'],
				'address' => "",
				'companyPictures' => "",
				'introduction' => ""
			);
		} else {
			$result['companyInfo'] = array(
				'agencyName' => $userInfo['agencyName'],
				'address' => $result1[0]['address'],
				'companyPictures' => $result1[0]['companyPicture'],
				'introduction' => $result1[0]['introduction']
			);
		}
		$this->load->view('travelAgencyView/companyInform', $result);
	}

	public function agencyInformationEditPage()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('session');

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$userInfo = $this->session->userdata('userInfo');
		$data = array(
			'agencyName' => $userInfo['agencyName']
		);
		$result1 = $this->travelAgencyBehavior->getCompanyInform($data);
		if (count($result1) == 0) {
			$result['companyInfo'] = array(
				'agencyName' => $userInfo['agencyName'],
				'address' => "",
				'companyPictures' => "",
				'introduction' => ""
			);
		} else {
			$result['companyInfo'] = array(
				'agencyName' => $userInfo['agencyName'],
				'address' => $result1[0]['address'],
				'companyPictures' => $result1[0]['companyPicture'],
				'introduction' => $result1[0]['introduction']
			);
		}

		$this->load->view('travelAgencyView/companyInform', $result);
	}

	public function agencyInformationEdit()
	{


		//CompanyImage-Upload
		$config['upload_path'] = 'uploads/companyInfo';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10000;
		$config['file_name'] = time() . mt_rand();
		$this->load->library('upload', $config);
		$statusImage = $this->upload->do_upload('companyPictures');
		//if(!$statusImage){
		//echo "<script>alert('You must upload the company picture')</script>";
		//die;
		//}
		$wrong = $this->upload->display_errors();
		if ($wrong) {
			//print_r($wrong);
			//die;
		}
		$info = $this->upload->data();
		//print_r($info);
		//small picture
		$arr['source_image'] = $info['full_path'];
		$arr['create_thumb'] = FALSE;
		$arr['maintain_ratio'] = TRUE;
		$arr['width'] = 200;
		$arr['height'] = 200;
		$this->load->library('image_lib', $arr);
		$this->image_lib->resize();

		//print_r('A');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();

		//print_r('B');
		$this->form_validation->set_rules('address', 'address', 'required');
		//$this->form_validation->set_rules('companyPictures', 'Company Pictures', 'required');
		$this->form_validation->set_rules('company_introduction', 'company_introduction', 'required');

		$status = $this->form_validation->run();
		//print_r("c");
		if ($status && $statusImage) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$userInfo = $this->session->userdata('userInfo');
			$data = array(
				'agencyName' => $userInfo['agencyName'],
				'address' => $_POST['address'],
				'companyPicture' => $info['file_name'],
				'introduction' => $_POST['company_introduction']
			);
			$this->travelAgencyBehavior->editCompanyInfo($data);
			echo "<script>alert('Edit successfully')</script>";
			$this->showCompanyInform();
			//print_r("d");
		} else if ($status && (!$statusImage)) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$userInfo = $this->session->userdata('userInfo');
			$data = array(
				'agencyName' => $userInfo['agencyName'],
				'address' => $_POST['address'],
				'introduction' => $_POST['company_introduction']
			);
			$this->travelAgencyBehavior->editCompanyInfo($data);
			echo "<script>alert('Edit successfully')</script>";
			$this->showCompanyInform();
		} else {
			//print_r("e");
			$this->agencyInformationEditPage();
		}
	}

	public function forgetPasswordPage()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->view('travelAgencyView/forget_password');
	}

	public function showSecurityPage()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();

		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		//$userInfo=$this->session->userdata('userInfo');
		//echo $_POST['agencyName'];
		//echo $_POST['userName'];
		$data = array(
			'agencyName' => $_POST['agencyName'],
			'userName' => $_POST['userName'],
		);
		$data1 = array(
			'agencyName' => $_POST['agencyName'],
			'accountName' => $_POST['userName'],
		);
		if ($_POST['agencyName'] == null || $_POST['userName'] == null) {
			$this->index();
		} else {
			if($this->travelAgencyBehavior->checkWhetherExist($data1)){
				$this->session->set_userData('userInfo3', $data);
				$result['problems'] = $this->travelAgencyBehavior->getSecurityProblem($data);
				//print_r($result["problems"][0]['problem1']);
				//print_r($result["problems"][0]['problem2']);
				$this->load->view('travelAgencyView/checkSecurityProblem', $result);

			}
			else{
				echo "<script>alert('Agency name or name wrong')</script>";
				$this->forgetPasswordPage();
			}

		}

	}

	public function checkProblemAns()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();

		$this->form_validation->set_rules('answer1', 'answer1', 'required');
		$this->form_validation->set_rules('answer2', 'answer2', 'required');
		$status = $this->form_validation->run();
		if ($_POST['answer1'] == null || $_POST['answer2'] == null) {
			$this->index();
		} else {
			if ($status) {
				$this->load->model('travelAgencyModel/travelAgencyBehavior');
				$userInfo = $this->session->userdata('userInfo3');
				$data = array(
					'agencyName' => $userInfo['agencyName'],
					'userName' => $userInfo['userName'],
					'answer1' => $_POST['answer1'],
					'answer2' => $_POST['answer2']
				);
				if ($this->travelAgencyBehavior->checkAns($data)) {
					$this->load->view('travelAgencyView/changeNewPassword');
				} else {
					echo "<script>alert('Your answer for the questions is not correct')</script>";
					$this->index();
				}
			} else {
				$this->index();
			}
		}
	}

	public function changePassword()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();

		$this->form_validation->set_rules('newPassword', 'newPassword', 'required');
		$status = $this->form_validation->run();
		if ($status) {
			$this->load->model('travelAgencyModel/travelAgencyBehavior');
			$hash = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
			$userInfo = $this->session->userdata('userInfo3');
			$data = array(
				'agencyName' => $userInfo['agencyName'],
				'userName' => $userInfo['userName'],
				'newPassword' => $hash
			);
			$this->travelAgencyBehavior->updateNewPassword($data);
			echo "<script>alert('Change successfully')</script>";
			$this->load->view('travelAgencyView/login');
			//$this->load->view('travelAgencyView/changeNewPassword');
		} else {
			$this->load->view('travelAgencyView/changeNewPassword');
		}

	}

	public function searchPlace()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$keyword = $this->input->post('keyword');
		$data['results'] = $this->elec5620model->search($keyword);
		$this->load->view('travelAgencyView/search_view_place', $data);
	}

	public function searchItinerary()
	{
		$this->load->database();
		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$keyword = $this->input->post('keyword');
		$userInfo = $this->session->userdata('userInfo');
		$result['allItinerary'] = $this->travelAgencyBehavior->searchItinerary($keyword, $userInfo['agencyName']);
		$this->load->view('travelAgencyView/search_view_itinerary', $result);
	}

	public function findMostPopView()
	{
		$this->load->database();
		$this->load->model('elec5620model');
		$data['results'] = $this->elec5620model->findMostPopView();
		$this->load->view('travelAgencyView/hotPlace', $data);
	}

	public function addAdvertise()
	{
		$this->load->database();
		$this->load->model('travelAgencyModel/travelAgencyBehavior');
		$userInfo = $this->session->userdata('userInfo');
		$pID = $this->uri->segment(3);
		$data = array(
			'agencyName' => $userInfo['agencyName'],
			'pid' => $pID
		);
		if ($this->travelAgencyBehavior->addAdvertisement($data)) {
			echo "<script>alert('Successful')</script>";
			$this->findMostPopView();
		} else {
			echo "<script>alert('Existing Advertisement')</script>";
			$this->findMostPopView();
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
		$this->load->view("travelAgencyView/pictureDetail", $data);

	}

	public function logout()
	{
		unset($_SESSION['userInfo']);
		$this->load->view('travelAgencyView/login');
		echo "<script>alert('Log out successful')</script>";
	}

}
