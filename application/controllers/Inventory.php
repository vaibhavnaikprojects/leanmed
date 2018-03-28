<?php
	class Inventory extends CI_Controller{
		public function index(){
			$data['title']= 'Inventory';
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$this->load->view('pages/inventory');
			$this->load->view('templates/footer');
		}
		public function editItem(){
			$form_data = $this->input->post();
			print_r($form_data);
		}
		public function editStorage(){
			$form_data = $this->input->post();
			print_r($form_data);
		}
		public function editRoom(){
			$form_data = $this->input->post();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			if($form_data['oper']== 'add')
				$this->inventory_model->add_room($form_data);
			elseif ($form_data['oper']== 'edit') 
				$this->inventory_model->edit_room($form_data);
			elseif ($form_data['oper']== 'del') {
				$this->inventory_model->del_room($form_data);
			}
			header('Content-Type: application/json');
			echo json_encode(true);
		}

		public function items(){
			$form_data = $this->input->get();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
		}

		public function storage(){
			$form_data = $this->input->get();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
		}

		public function rooms(){
			$form_data = $this->input->get();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			header('Content-Type: application/json');
			echo json_encode($this->inventory_model->get_rooms($form_data));
		}
	}