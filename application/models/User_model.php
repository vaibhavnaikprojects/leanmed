<?php
	class User_model extends CI_Model{
		public function getUser($email,$password){
			$query = $this->db->get_where('users',array('emailId'=> $email,'password'=> md5($password)));
			return $query -> row_array();
		}
		public function getUserById($email){
			$query = $this->db->get_where('users',array('emailId'=> $email));
			return $query -> row_array();
		}
		public function getUserByPassword($password){
			$query = $this->db->get_where('users',array('password'=> $password));
			return $query -> row_array();
		}
		public function registerUser($form_data){
			$query = $this->db->get_where('users',array('emailId'=> $form_data['emailId']));
			$user= $query -> row_array();
			if($user!='' && $user['status']=='pending'){
				$this->db->where('emailId', $form_data['emailId']);
				$data = array(
					 	'userName'=>$form_data['userName'],
					 	'password'=>md5($form_data['password']),
					 	'userType'=>$form_data['userType'],
					 	'status'=>'active'
					 );
					 $this->db->update('users',$data);
			}
			elseif ($user!='') {
				return "user already exist";
			}
			else{
				if($form_data['userType']==1){
					 $data = array(
					 	'userName'=>$form_data['userName'],
					 	'emailId'=>$form_data['emailId'],
					 	'password'=>md5($form_data['password']),
					 	'userType'=>$form_data['userType'],
					 	'status'=>'active'
					 );
					 $this->db->insert('users',$data);
					 $houseData= array(
					 	'houseName'=>$form_data['houseName'],
					 	'houseDesc'=>$form_data['houseDesc'],
					 	'houseKey'=>$this->generateKey(),
					 	'admin'=>$form_data['emailId']
					 );
					$this->db->insert('houses',$houseData);
					$houseId = $this->db->insert_id();
					$this->db->where('emailId', $form_data['emailId']);
					$userData=array('houseId'=>$houseId);
					$this->db->update('users', $userData);
					return "Registeration Successful";
				}
				else{
					$house=$this->getHouse($form_data['houseId']);
					if($house!='' && $house['houseKey']==$form_data['houseKey']){
						$data = array(
						'userName'=>$form_data['userName'],
					 	'emailId'=>$form_data['emailId'],
					 	'password'=>md5($form_data['password']),
					 	'userType'=>$form_data['userType'],
					 	'houseId' =>$form_data['houseId'],
					 	'status'=>'active'
					 	);
					 	$this->db->insert('users',$data);
					 	return "Registeration Successful";
					}
					else if($house!='')
						return "Invalid House Id";
					else
						return "Invalid House Key";
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

		public function forgot_pass($emailId,$password){
			$this->db->where('emailId', $emailId);
			$userData=array('password'=>md5($password));
			$this->db->update('users', $userData);
		}

		public function get_logs(){
			$query=$this->db->query("select * from logs order by logId desc");
			return $query -> result_array();
		}

		public function add_user($form_data){
			$data = array(
					 	'emailId'=>$form_data['emailId'],
					 	'userName'=>$form_data['userName'],
					 	'userType'=>2,
					 	'houseId'=>$form_data['houseId'],
					 	'status'=>'pending',
					 );
			$this->db->insert('users',$data);
			$this->log($this->session->userdata('user')['userName'].' invited user '.$form_data['userName'].' to the house',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
			$house=$this->getHouse($form_data['houseId']);
			$url = base_url()."daemon/send";
			$param = array(
				'userId' => $form_data['emailId'],
				'subject' => 'Item Finder: Admin of house '.$house['houseName'].' has invited you to join the house',
				'message' => 'Please register yourself with the house Id: '.$house['houseId']. ' and house key: '.$house['houseKey']
			);
			$this->asynclibrary->daemon($url, $param);
		}
		public function edit_user($form_data){
		}
		public function del_user($form_data){
			$this->db->where_in('emailId', explode(",",$form_data['id']));
   			$this->db->delete('users');
   			$this->log($this->session->userdata('user')['userName'].' removed the user '.$form_data['id'].' from the house',$this->session->userdata('user')['emailId'],$this->session->userdata('users'));
		}

		public function log($log,$userId,$users){
			$url = base_url()."daemon/add_log";
			$param = array('log' => $log,
				'userId' => $userId,
				'users' => $users
			);
			$this->asynclibrary->daemon($url, $param);
		}

		public function getApprovalsByHouseId($houseId){
			$approval=array();
			$query=$this->db->query("select * from storage where roomId in (select roomId from rooms where houseId=".$houseId.") and status='pending' order by storageId desc");
			$approval1=$query -> result_array();
			for($x=0;$x<count($approval1);$x++){
				$test = array('message' => $approval1[$x]['history'], 'userId' =>$approval1[$x]['userId'], 'storageId' =>$approval1[$x]['storageId'],'table' => 'storage');
				array_push($approval, $test);
			}
			

			$itemQuery=$this->db->query("select i.* from items i,storage s,rooms r where i.storageId=s.storageId and s.roomId=r.roomId and r.houseId=".$houseId." and i.status='pending' order by itemId desc");
			$approval2=$itemQuery -> result_array();
			for($x=0;$x<count($approval2);$x++){
				$test = array('message' => $approval2[$x]['history'], 'userId' =>$approval2[$x]['userId'], 'storageId' =>$approval2[$x]['itemId'],'table' => 'items');
				array_push($approval, $test);
			}
			

			return $approval;
		}
	}