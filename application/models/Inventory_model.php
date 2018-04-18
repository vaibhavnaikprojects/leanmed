<?php
	class Inventory_model extends CI_Model{
		public function add_room($form_data){
			$data = array(
					 	'roomName'=>$form_data['roomName'],
					 	'roomDesc'=>$form_data['roomDesc'],
					 	'houseId'=>$form_data['houseId']
					 );
			$this->db->insert('rooms',$data);
			$this->log($this->session->userdata('user')['userName'].' added room named '.$form_data['roomName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
		}

		public function edit_room($form_data){
			$this->db->where('roomId', $form_data['id']);
			$data = array(
					 	'roomName'=>$form_data['roomName'],
					 	'roomDesc'=>$form_data['roomDesc']
					 );
			$this->db->update('rooms',$data);
			$this->log($this->session->userdata('user')['userName'].' edited room named '.$form_data['roomName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
		}

		public function del_room($form_data){
			$this->db->where_in('roomId', explode(",",$form_data['id']));
   			$this->db->delete('rooms');
   			$this->log($this->session->userdata('user')['userName'].' deleted a room',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
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
					 	'userId'=>$this->session->userdata('user')['emailId'],
					 	'roomId'=>$form_data['roomName']
					 );
				if($this->session->userdata('user')['userType']==1){
					$data['status']='active';
					$this->db->insert('storage',$data);
					$this->log($this->session->userdata('user')['userName'].' added storage named '.$form_data['storageName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
				}
				else{
					$data['status']='pending';
					$data['history']=$this->session->userdata('user')['userName'].' wants to add storage named '.$form_data['storageName'];
					$this->db->insert('storage',$data);
					$this->log($this->session->userdata('user')['userName'].' wants to add storage named '.$form_data['storageName'],$this->session->userdata('user')['emailId'],$this->session->userdata('admin'));
				}
		}

		public function edit_storage($form_data){
			$this->db->where('storageId', $form_data['id']);
			$data = array(
					 	'storageName'=>$form_data['storageName'],
					 	'storageDesc'=>$form_data['storageDesc'],
					 	'userId'=>$this->session->userdata('user')['emailId'],
					 	'roomId'=>$form_data['roomName']
					 );
			if($this->session->userdata('user')['userType']==1){
					$data['status']='active';
					$this->db->update('storage',$data);
					$this->log($this->session->userdata('user')['userName'].' edited storage named '.$form_data['storageName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
				}
				else{
					$data['status']='pending';
					$data['history']=$this->session->userdata('user')['userName'].' wants to edit storage named '.$form_data['storageName'];
					$this->db->update('storage',$data);
					$this->log($this->session->userdata('user')['userName'].' wants to edit storage named '.$form_data['storageName'],$this->session->userdata('user')['emailId'],$this->session->userdata('admin'));
				}
		}

		public function del_storage($form_data){
			if($this->session->userdata('user')['userType']==1){
				$this->db->where_in('storageId', explode(",",$form_data['id']));
   				$this->db->delete('storage');
   				$this->log($this->session->userdata('user')['userName']. 'deleted storage',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
   			}
		}

		public function get_storage($form_data){
			$query = $this->db->query('select s.storageId,s.storageName,s.storageDesc,s.userId,s.status,r.roomId,r.roomName from storage s,rooms r where s.roomId in (select r.roomId from rooms where houseId='.$form_data['houseId'].') and s.roomId=r.roomId');
			return $query -> result_array();
		}
		
		public function get_rooms_by_house_id($id){
			$query = $this->db->query('select roomId,roomName from rooms where houseId='.$id);
			return $query -> result_array();
		}
		public function get_items($form_data){
			$query = $this->db->query("select i.itemId, i.itemName,i.itemType, i.itemDesc,s.storageName,r.roomName, u.userName from storage s,rooms r, items i, users u where s.roomId in (select r.roomId from rooms where houseId=".$form_data['houseId'].") and s.roomId=r.roomId and i.storageId = s.storageId and u.emailId = ". "'".$form_data['emailId']."'"." and u.emailId = i.userId");
			return $query -> result_array();
		}
		
		public function del_item($form_data){
			$this->db->where_in('itemId', $form_data['id']);
   			$this->db->delete('items'); 
   			$this->log($this->session->userdata('user')['userName']. 'deleted item',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
		}

		public function log($log,$userId,$users){
			$url = base_url()."daemon/add_log";
			$param = array('log' => $log,
				'userId' => $userId,
				'users' => $users
			);
			$this->asynclibrary->daemon($url, $param);
		}

		public function sendEmail($userId,$subject,$message){
			$url = base_url()."daemon/send";
			$param = array('userId' => $userId,
				'subject' => $subject,
				'message' => $message
			);
			$this->asynclibrary->daemon($url, $param);
		}

		public function add_item($form_data){
			$query = $this->db->query("select storageId from storage where storageName="."'".$form_data['storageName']."'");
			$storageId = "";
			foreach ($query->result_array() as $row) {
				$storageId = $row['storageId'];
			}
			$data = array(
					 	'itemName'=>$form_data['itemName'],
					 	'itemType'=>$form_data['itemType'],
					 	'storageId' =>$storageId,
					 	'updatedBy' =>$this->session->userdata('user')['emailId'],
					 	'itemDesc' =>$form_data['itemDesc'],
					 	'userId'=>$this->session->userdata('user')['emailId']
					 );

				$this->sendEmail('prakhar.sapre2610@gmail.com','hello','hello');

				/*if(strtolower($data['itemType']) == "shared"){
					$emailSubject = $this->session->userdata('user')['userName'].' added item named '.$form_data['itemName'];
					$allUserEmails = $this->user_model->getUsersByHouseId($form_data['houseId']);
					$this->sendEmail('prakhar.sapre2610@gmail.com',$allUserEmails,$allUserEmails);
					foreach ($allUserEmails as $row){
						$this->user_model->sendEmail('prakhar.sapre2610@gmail.com','hello','hello');
					}

				}*/
				if($this->session->userdata('user')['userType']==1){
					$data['status']='active';
					$this->db->insert('items',$data);
					$this->log($this->session->userdata('user')['userName'].' added item named '.$form_data['itemName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
				}
				else{
					$data['status']='pending';
					$this->db->insert('items',$data);
					$this->log($this->session->userdata('user')['userName'].' wants to add storage named '.$form_data['storageName'],$this->session->userdata('user')['emailId'],$this->session->userdata('admin'));
				}
		}

		public function searchItem($form_data){
			$query = $this->db->query("select i.itemName,i.itemType, i.itemDesc,s.storageName,r.roomName,i.updatedBy from storage s,rooms r, items i, users u where s.roomId in (select r.roomId from rooms where i.itemName = "."'".$form_data['search']."'"." and houseId=".$form_data['houseId'].") and s.roomId=r.roomId and i.storageId = s.storageId and u.emailId = ". "'".$form_data['emailId']."'"." and u.emailId = i.userId");
			return $query->result_array();
		} 

		/*public function getItemNames($form_data){
			$query = "select i.itemName from storage s,rooms r, items i, users u where s.roomId in (select r.roomId from rooms where houseId=".$form_data['houseId'].") and s.roomId=r.roomId and i.storageId = s.storageId and u.emailId = ". "'".$form_data['emailId']."'"." and u.emailId = i.userId";
			return $query;
		}*/
	}
