<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class UserModel extends CI_Model{
		public function system_auth($userCheck,$adminCheck){
			$auth=$this->input->get_request_header('Auth-Key',TRUE);
			if($auth=="leanmedapi"){
				if($userCheck==true){
					return $this->user_auth($adminCheck);
				}
				return true;
			}
			else
				return json_output(401,array('status' => 401,'message' => 'Unauthorized'));
		}

		public function user_auth($adminCheck){
			$users_id  = $this->input->get_request_header('User-ID', TRUE);
        	$token     = $this->input->get_request_header('Authorization', TRUE);
        	$q= $this->db->get_where('users',array('emailId' -> $users_id,),'password'->$token) -> row_array();
        	if($q == "")
        		return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));	
        	else{
        		if($adminCheck==true && $query_record['password']==3)
        			return true;
        		else if($adminCheck==false)
        			return true;
        		else
        			return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));		
        	}
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

		public function login($email,$password){
			$query_record = $this->db->get_where('users',array('emailId'=> $email)) -> row_array();
			if($query==''){
				return array('status' => 204,'message' => 'User not found');		
			}
			elseif($query_record['password']==md5($password)){
				return array('status' => 200, 'message' => 'Login Successful','token' => md5($password));
			}else{
				return array('status' => 204,'message' => 'Wrong Password'); 
			}			
		}

		public function forgot_pass($emailId,$password){
			$this->db->where('emailId', $emailId);
			$userData=array('password'=>md5($password));
			$this->db->update('users', $userData);
		}

		public function getUserById($email){
			$sql="SELECT u.*,z.zone,z.Zone_Name,z.Zone_Country,z.Zone_Email FROM users u, zone z WHERE u.Zone_Id=z.Zone_Id and user_email='".$email."'";
			return $this->db->query($sql)->result_array();
		}
		public function getUsersByType($type){
			$sql="SELECT u.*,z.zone,z.Zone_Name,z.Zone_Country,z.Zone_Email FROM users u, zone z WHERE u.Zone_Id=z.Zone_Id and user_type=".$type;
			return $this->db->query($sql)->result_array();
		}

		public function getUsersByZone($zone){
			$sql="SELECT u.*,z.zone,z.Zone_Name,z.Zone_Country,z.Zone_Email FROM users u, zone z WHERE u.Zone_Id=z.Zone_Id and Zone_Id='".$zone."'";
			return $this->db->query($sql)->result_array();
		}
		public function getUsersByStatus($status){
			$sql="SELECT u.*,z.zone,z.Zone_Name,z.Zone_Country,z.Zone_Email FROM users u, zone z WHERE u.Zone_Id=z.Zone_Id and User_Status=".$status;
			return $this->db->query($sql)->result_array();
		}
		
		public function getZones(){
			return $this->db->select('Zone_Id,Zone_Name')->from('zone')->get()->result_array();
		}
		public function getZonesByCountry($zoneCountry){
			$query_record = $this->db->select('Zone_Id,Zone_Name')->where(array('Zone_Country'=> $zoneCountry))->from('zone')->get()-> result_array();
			return $query_record;
		}
		public function getZoneById($zoneId){
			$query_record = $this->db->get_where('zone',array('Zone_Id'=> $zoneId)) -> row_array();
			return $query_record;
		}


		public function sendEmail($to_email,$subject,$message){
			$this->email->from('vaibhavsnaik09@gmail.com', 'Item Finder Support'); 
        	$this->email->to($to_email);
        	$this->email->subject($subject); 
        	$this->email->message($message);
        	$this->email->set_mailtype("html"); 	
        	$this->email->send();
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
	}