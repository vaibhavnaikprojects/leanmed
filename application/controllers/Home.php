<?php
	class Home extends CI_Controller{
		public function index(){
			if($this->session->userdata('user')==""){
				$this->session->set_flashdata("message",'Session Expired');
				redirect('login');
			}
			$data['title']= 'Home';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$user=$this->session->userdata('user');
			//$data['items']=$this->inventory_model->get_items($user);
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
				if($data['user']['userType']!=1){
					$adminId=$this->user_model->get_admin_email($data['user']['houseId']);
					$this->session->set_userdata('admin', $adminId['admin']);
				}
				$users=$this->user_model->get_house_users($data['user']['houseId']);
				$result = array();
				for($x=0;$x<count($users);$x++){
					$result[$x]=$users[$x]['emailId'];
				}
				$this->session->set_userdata('users', $result);

				redirect('home');
			}
			else{
				$this->session->set_flashdata("message","Invalid Credentials");
				redirect('login');
			}
		}
		public function logout(){
			$data['title']= 'Welcome';
			$this->session->sess_destroy();
			redirect('login');
		}
	}