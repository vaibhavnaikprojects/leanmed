<?php
class InventoryModel extends CI_Model{
	public function getMedicines($query){
		$query_record = $this->db->select('*')->from('inventory')->join('zone', 'inventory.Zone_Id = zone.Zone_Id')->join('medicine', 'inventory.Medicine_Id = medicine.Medicine_Id')->or_like(array('Generic_Name'=>$query,'Trade_Name'=>$query))->get()->result_array();
		return array('status' => 200, 'message' => 'success','inventory' => inventoryOutput($query_record));			
	}
}
