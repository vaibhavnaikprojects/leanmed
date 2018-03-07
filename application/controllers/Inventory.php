<?php
	class Inventory extends CI_Controller{
		public function index(){
			$data['title']= 'Inventory';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$this->load->view('pages/inventory');
			$this->load->view('templates/footer');
		}
	}