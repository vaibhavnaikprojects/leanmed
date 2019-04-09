<?php
	class Admin extends CI_Controller{
		public function index(){
			header('Content-Type: application/json');
			echo json_encode($this->user_model->getUsersByHouseId($this->session->userdata('user')['houseId']));

		}
		public function users(){
			header('Content-Type: application/json');
			echo json_encode($this->user_model->getUsersByHouseId($this->session->userdata('user')['houseId']));
		}
	}