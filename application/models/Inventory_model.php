<?php
	class Inventory_model extends CI_Model{
		public function add_room($form_data){
			$data = array(
					 	'roomName'=>$form_data['roomName'],
					 	'roomDesc'=>$form_data['roomDesc'],
					 	'houseId'=>$form_data['houseId']
					 );
			$this->db->insert('rooms',$data);
			$this->add_log($this->session->userdata('user')['userName'].' added room '.$form_data['roomName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
		}

		public function edit_room($form_data){
			$this->db->where('roomId', $form_data['id']);
			$data = array(
					 	'roomName'=>$form_data['roomName'],
					 	'roomDesc'=>$form_data['roomDesc']
					 );
			$this->db->update('rooms',$data);
			$this->add_log($this->session->userdata('user')['userName'].' edited room details '.$form_data['roomName'],$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
		}

		public function del_room($form_data){
			$this->db->where_in('roomId', $form_data['id']);
   			$this->db->delete('rooms');
   			$this->add_log('',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
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
					$this->add_log('',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
				}
				else{
					$data['status']='pending';
					$this->db->insert('storage',$data);
					$this->add_log('',$this->session->userdata('user')['emailId'],$this->session->userdata('admin'));
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
					$this->add_log('',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
				}
				else{
					$data['status']='pending';
					$this->db->update('storage',$data);
					$this->add_log('',$this->session->userdata('user')['emailId'],$this->session->userdata('admin'));
				}
		}

		public function del_storage($form_data){
			if($this->session->userdata('user')['userType']==1){
				$this->db->where_in('storageId', $form_data['id']);
   				$this->db->delete('storage');
   				$this->add_log('',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
   			}
		}

		public function get_storage($form_data){
			$query = $this->db->query('select s.storageId,s.storageName,s.storageDesc,r.roomId,r.roomName from storage s,rooms r where s.roomId in (select r.roomId from rooms where houseId='.$form_data['houseId'].') and s.roomId=r.roomId');
			return $query -> result_array();
		}
		
		public function get_rooms_by_house_id($id){
			$query = $this->db->query('select roomId,roomName from rooms where houseId='.$id);
			return $query -> result_array();
		}
		public function get_items($user){
			$query = $this->db->query('');
			return $query -> result_array();
		}
		

		public function del_item($form_data,$user){
			$this->db->where_in('itemId', $form_data['id']);
   			$this->db->delete('items'); 
		}


		public function add_log($log,$userId,$users){
			$data = array(
					 	'log'=>$log,
					 	'userId'=>$userId
					 );
			$this->db->insert('logs',$data);
			$logId = $this->db->insert_id();
			if (!is_array($users)) {
				$data = array(
					 	'logId'=>$logId,
					 	'emailId'=>$users,
					 	'status'=>'pending'
					 );
				$this->db->insert('logusers',$data);
				$this->sendEmail($users,$log,$log);	
			}
			else{
				for($i=0;$i<count($users);$i++){
				$data = array(
					 	'logId'=>$logId,
					 	'emailId'=>$users[$i],
					 	'status'=>'pending'
					 );
				$this->db->insert('logusers',$data);
				$this->sendEmail($users,$log,$log);	
				}
			}
		}
		public function sendEmail($to_email,$subject,$message){
			$this->email->from('vaibhavsnaik09@gmail.com', 'Item Finder Support'); 
        	$this->email->to($to_email);
        	$this->email->subject($subject); 
        	$this->email->message($message);
        	$this->email->set_mailtype("html"); 	
        	$this->email->send();
		}
	}
