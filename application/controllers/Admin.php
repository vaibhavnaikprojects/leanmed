<?php
	class Admin extends CI_Controller{
		public function index(){
			if($this->session->userdata('user')==""){
				$this->session->set_flashdata("message",'session expired');
				redirect('login');
			}
			elseif ($this->session->userdata('user')['userType']==2) {
				$this->session->set_flashdata("message",'Forbidden Access');
				redirect('home');
			}
			$data['title']= 'Admin';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$this->load->view('pages/admin');
			$this->load->view('templates/footer');
		}
	}