<?php
	class Inventory_model extends CI_Model{
		public function get_items($user){
			$query = $this->db->get_where('items',array('houseId'=> $user['houseId'],'itemType'=>'s'));
			$result= $query -> result_array();
			$query = $this->db->get_where('items',array('userId'=> $user['userId'],'itemType'=>'p'));
			return $result;
		} 
	}