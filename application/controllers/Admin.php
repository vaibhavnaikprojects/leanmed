<?php
	class Admin extends CI_Controller{
		public function index(){
			$data['title']= 'Admin';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$this->load->view('pages/admin');
			$this->load->view('templates/footer');
		}
	}