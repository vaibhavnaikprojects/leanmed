<?php
	class User extends CI_Controller{
		public function index(){
			$method=$_SERVER['REQUEST_METHOD'];
			if($method!='GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			}
			else if($this->UserModel->system_auth(true,true)==true){
				$resp=$this->UserModel->getAllUsers();
				json_output($resp['status'],$resp);
			}
		}

		public function detail($id){
			$method=$_SERVER['REQUEST_METHOD'];
			if($method!='GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			}
			else if($this->UserModel->system_auth(true,true)==true){
				$resp=$this->UserModel->getUserById($id);
				json_output($resp['status'],$resp);
			}
		}

		public function zones(){
			$method=$_SERVER['REQUEST_METHOD'];
			if($method!='GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			}
			else if($this->UserModel->system_auth(false,false)==true){
				$resp=$this->UserModel->getZones();
				json_output(200,$resp);
			}
		}

		public function zoneDetail($id){
			$method=$_SERVER['REQUEST_METHOD'];
			if($method!='GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			}
			else if($this->UserModel->system_auth(true,false)==true){
				$resp=$this->UserModel->getZoneById($id);
				json_output($resp['status'],$resp);
			}
		}

		public function zoneByCountry($country){
			$method=$_SERVER['REQUEST_METHOD'];
			if($method!='GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			}
			else if($this->UserModel->system_auth(false,false)==true){
				$resp=$this->UserModel->getZonesByCountry($country);
				json_output(200,$resp);
			}
		}

		public function login(){
			$method=$_SERVER['REQUEST_METHOD'];
			if ($method!='POST') {
				json_output(400,array('status' => 400, 'message' => 'Bad Request'));
			}
			else if($this->UserModel->system_auth(false,false)==true){
				$response=$this->user_model->login($_REQUEST['username'],$_REQUEST['cred']);
				json_output($response['status'],$response);
			}
		}

		public function register(){
			$method=$_SERVER['REQUEST_METHOD'];
			if ($method!='POST') {
				json_output(400,array('status' => 400, 'message' => 'Bad Request'));
			}
			else{
				$response=$this->user_model->register();
				json_output($response['status'],$response);
			}
		}

	}