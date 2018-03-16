<?php
	class Forgot extends CI_Controller{
		public function index(){
			$data['title']= 'Forgot Password';
			$this->load->view('templates/header');
			$this->load->view('pages/forgot',$data);
			$this->load->view('templates/footer');
		}
		public function forgotpass(){
			$data['title']= 'Home';
			$form_data = $this->input->post();
			$data['user'] = $this->user_model->getUserById($form_data['emailId']);
			if($data['user']!=""){
				$this->email->from('vaibhavsnaik09@gmail.com', 'Item Finder Support');
				$this->email->to($form_data['emailId']);
				$this->email->subject('Password Recovery');
				$this->email->set_mailtype("html");
				$this->email->message('Please click on the <a href=")'.$this->config->base_url()."/change/".$data['user']['password'].'">link</a> to recover your password');
				$this->email->send();
				$this->session->set_flashdata("message","Recovery email sent to your mail id");
				//redirect('forgot');
			}
			else{
				$this->session->set_flashdata("message","EmailId not found");
				redirect('forgot');
			}
		}
	}