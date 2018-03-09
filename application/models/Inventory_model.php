<?php
	class Inventory_model extends CI_Model{
		public function get_items($user){
			//$query = $this->db->get_where('items',array('houseId'=> $user['houseId'],'itemType'=>'s'));
			
			$query = $this->db->get_where('items',array('userId'=> $user['emailId'],'itemType'=>'p'));
			$result= $query -> result_array();
			return $result;
		} 
	}