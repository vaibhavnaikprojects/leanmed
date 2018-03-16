<?php
	class Home extends CI_Controller{
		public function index(){
			$data['title']= 'Home';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$user=$this->session->userdata('user');
			$data['items']=$this->inventory_model->get_items($user);
			$this->load->view('pages/home',$data);
			$this->load->view('templates/footer');
		}
		public function login(){
			$data['title']= 'Home';
			$form_data = $this->input->post();
			$data['user'] = $this->user_model->getUser($form_data['emailId'],$form_data['password']);
			print_r($form_data['emailId'].$form_data['password'].$data['user']['userName']);
			if($data['user']!=""){
				$this->session->set_userdata('user', $data['user']);
				redirect('home');
			}
			else{
				$this->session->set_flashdata("message",$form_data['emailId'].md5($form_data['password']).$data['user']['userName']);
				redirect('login');
			}
		}
		public function logout(){
			$data['title']= 'Welcome';
			$this->session->sess_destroy();
			redirect('login');
		}
	}