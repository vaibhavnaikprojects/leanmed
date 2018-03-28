<?php
	class Inventory_model extends CI_Model{
		public function get_items($user){
			//$query = $this->db->get_where('items',array('houseId'=> $user['houseId'],'itemType'=>'s'));
			
			$query = $this->db->get_where('items',array('userId'=> $user['emailId'],'itemType'=>'p'));
			$result= $query -> result_array();
			return $result;
		}
		public function add_room($form_data){
			$data = array(
					 	'roomName'=>$form_data['roomName'],
					 	'roomDesc'=>$form_data['roomDesc'],
					 	'houseId'=>$form_data['houseId']
					 );
			$this->db->insert('rooms',$data);
		}

		public function edit_room($form_data){
			$this->db->where('roomId', $form_data['id']);
			$data = array(
					 	'roomName'=>$form_data['roomName'],
					 	'roomDesc'=>$form_data['roomDesc']
					 );
			$this->db->update('rooms',$data);
		}

		public function del_room($form_data){
			$this->db->where_in('roomId', $form_data['id']);
   			$this->db->delete('rooms'); 
		}

		public function get_rooms($form_data){
			$query = $this->db->get_where('rooms',array('houseId'=> $form_data['houseId']));
			$result= $query -> result_array();
			return $result;
		}

		public function add_storage($form_data){
			$data = array(
					 	'storageName'=>$form_data['storageName'],
					 	'storageDesc'=>$form_data['storageDesc'],
					 	'roomId'=>$form_data['roomName']
					 );
			$this->db->insert('storage',$data);
		}

		public function edit_storage($form_data){
			$this->db->where('storageId', $form_data['id']);
			$data = array(
					 	'storageName'=>$form_data['storageName'],
					 	'storageDesc'=>$form_data['storageDesc'],
					 	'roomId'=>$form_data['roomName']
					 );
			$this->db->update('storage',$data);
		}

		public function del_storage($form_data){
			$this->db->where_in('storageId', $form_data['id']);
   			$this->db->delete('storage'); 
		}

		public function get_storage($form_data){
			$query = $this->db->query('select s.storageId,s.storageName,s.storageDesc,r.roomId,r.roomName from storage s,rooms r where s.roomId in (select r.roomId from rooms where houseId='.$form_data['houseId'].') and s.roomId=r.roomId');
			return $query -> result_array();
		}
		
		public function get_rooms_by_house_id($id){
			$query = $this->db->query('select roomId,roomName from rooms where houseId='.$id);
			return $query -> result_array();
		}

		
	}
