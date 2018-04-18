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
		public function users(){
			header('Content-Type: application/json');
			echo json_encode($this->user_model->getUsersByHouseId($this->session->userdata('user')['houseId']));
		}
		public function editUser(){
			$form_data = $this->input->post();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			if($form_data['oper']== 'add')
				$this->user_model->add_user($form_data);
			elseif ($form_data['oper']== 'edit') 
				$this->user_model->edit_user($form_data);
			elseif ($form_data['oper']== 'del') {
				$this->user_model->del_user($form_data);
			}
			header('Content-Type: application/json');
			echo json_encode(true);
		}
		public function approvals(){
			header('Content-Type: application/json');
			echo json_encode($this->user_model->getApprovalsByHouseId($this->session->userdata('user')['houseId']));
		}

		public function manageApproval(){
			$result = $this->input->post();
			if($result['action'] == 'approve'){
				if($result['table'] == 'storage'){
					$query = $this->db->query("update storage set status='active' where storageId=".$result['id']);
				}
				else if($result['table']== 'items'){
					$query = $this->db->query("update items set status='active' where itemId=".$result['id']);
				}
			}else{
				if($result['table'] == 'storage'){
					$query = $this->db->query("update storage set status='declined' where storageId=".$result['id']);
				}
				else if($result['table']== 'items'){
					$query = $this->db->query("update items set status='declined' where itemId=".$result['id']);
				}
			}
			redirect('admin');
		}

	}