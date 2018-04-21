<?php
	class Inventory extends CI_Controller{
		public function index(){
			if($this->session->userdata('user')==""){
				$this->session->set_flashdata("message",'session expired');
				redirect('login');
			}
			$data['title']= 'Inventory';
			$data['storagerooms']= $this->storagerooms();
			$data['storages']=$this->storages();
			$data['itemTypes']=$this->itemTypes();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/nav');
			$this->load->view('pages/inventory',$data);
			$this->load->view('templates/footer');
		}
		public function items(){
			$form_data = $this->input->get();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			$form_data['emailId']=$this->session->userdata('user')['emailId'];
			header('Content-Type: application/json');
			echo json_encode($this->inventory_model->get_items($form_data));
		}
		public function editItem(){
			$form_data = $this->input->post();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			if($form_data['oper']== 'add')
				$this->inventory_model->add_item($form_data);
			elseif ($form_data['oper']== 'edit') 
				$this->inventory_model->edit_item($form_data);
			elseif ($form_data['oper']== 'del') {
				$this->inventory_model->del_item($form_data);
			}
			header('Content-Type: application/json');
			echo json_encode(true);
		}
		public function rooms(){
			$form_data = $this->input->get();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			print_r($form_data);
			header('Content-Type: application/json');
			echo json_encode($this->inventory_model->get_rooms($form_data));
		}

		public function storages(){
			$storages=$this->inventory_model->get_storageNames();
			$str='';
			for ($x = 0; $x <count($storages); $x++) {
			    $str=$str.$storages[$x]['storageId'].":".$storages[$x]['storageName'].";";
			}
			return $str;
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

		public function storage(){
			$form_data = $this->input->get();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			header('Content-Type: application/json');
			echo json_encode($this->inventory_model->get_storage($form_data));
		}
		public function editStorage(){
			$form_data = $this->input->post();
			$form_data['houseId']=$this->session->userdata('user')['houseId'];
			if($form_data['oper']== 'add')
				$this->inventory_model->add_storage($form_data);
			elseif ($form_data['oper']== 'edit') 
				$this->inventory_model->edit_storage($form_data);
			elseif ($form_data['oper']== 'del') {
				$this->inventory_model->del_storage($form_data);
			}
			header('Content-Type: application/json');
			echo json_encode(true);
		}
		public function storagerooms(){
			$rooms=$this->inventory_model->get_rooms_by_house_id($this->session->userdata('user')['houseId']);
			$str='';
			for ($x = 0; $x <count($rooms); $x++) {
			    $str=$str.$rooms[$x]['roomId'].':'.$rooms[$x]['roomName'].';';
			}
			return $str;
		}

		public function itemTypes(){
			$str = 'personal:personal;shared:shared';
			return $str;			
		}
	}