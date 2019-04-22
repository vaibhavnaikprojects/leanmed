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
        	$q= $this->db->get_where('users',array('User_Email' => $users_id,'Password' => $token)) -> row_array();
        	if($q == "")
        		return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));	
        	else{
        		if($adminCheck==true && $q['User_Type']==3)
        			return true;
        		else if($adminCheck==false)
        			return true;
        		else
        			return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));		
        	}
		}

		public function registerUser($userArr){
			$query = $this->db->get_where('users',array('user_email'=> $userArr['emailId']));
			$user= $query -> row_array();
			if ($user!='') {
				return "user already exist with status ".$user['User_Status'];
			}
			$val=$this->checkUserValidation($userArr);
			if($val=='success'){
				$data = array(
					 'User_Name'=>$userArr['userName'],
					 'User_Email'=>$userArr['emailId'],
					 'Password'=>md5($userArr['password']),
					 'User_Type'=>$userArr['type'],
					 'User_Address'=>$userArr['userAddress'],
					 'User_City'=>$userArr['city'],
					 'User_State'=>$userArr['state'],
					 'User_Country'=>$userArr['country'],
					 'Phone'=>$userArr['contacts'],
					 'Language_Pref'=>$userArr['languagePref'],
					 'User_Type'=>$userArr['type'],
					 'User_Status'=>$userArr['userStatus'],
					);
				if($data['User_Type']==2) $data['Zone_Id']=$userArr['zone']['zoneId'];
				$this->db->insert('users',$data);
				return $userArr['emailId']." registeration successful";
			}
			else{
				return $val;
			}
		}

		private function checkUserValidation($userArr){
			return "success";
		}

		public function login($jsonArray){
			$query_record = $this->db->get_where('users',array('user_email'=> $jsonArray['emailId'])) -> row_array();
			if($query_record==''){
				return array('status' => 204,'message' => 'User not found');		
			}
			elseif($query_record['Password']==md5($jsonArray['password'])){
				if($query_record['User_Status']==2){
					$result= array('status' => 200, 'message' => 'Login Successful','user' => userOutput($query_record));
					$result['token']=$query_record['Password'];
					return $result;
				}
				else{
					return array('status' => 204, 'message' => 'User is inactive, Please contact admin');	
				}
			}else{
				return array('status' => 204,'message' => 'Wrong Password'); 
			}			
		}

		public function forgot_pass($emailId,$password){
			$this->db->where('emailId', $emailId);
			$userData=array('password'=>md5($password));
			$this->db->update('users', $userData);
		}

		public function getAllUsers(){
			$this->db->select('*')->from('users')->join('zone', 'users.Zone_Id = zone.Zone_Id');
			return $this->db->get()->result_array();
		}

		public function getUserById($email){
			$this->db->select('*')->from('users')->join('zone', 'users.Zone_Id = zone.Zone_Id')->where('user_email =', $email);
			return $this->db->get()->row_array();
		}
		public function getUsersByType($type){
			$this->db->select('*')->from('users')->join('zone', 'users.Zone_Id = zone.Zone_Id')->where('user_type =', $type);
			return $this->db->get()->result_array();
		}

		public function getUsersByZone($zone){
			$this->db->select('*')->from('users')->join('zone', 'users.Zone_Id = zone.Zone_Id')->where('Zone_Id =', $zone);
			return $this->db->get()->result_array();
		}
		public function getUsersByStatus($status){
			$this->db->select('*')->from('users')->join('zone', 'users.Zone_Id = zone.Zone_Id')->where('User_Status =', $status);
			return $this->db->get()->result_array();
		}
		public function getZones(){
			return $this->db->select('Zone_Id,Zone_Name')->from('zone')->get()->result_array();
		}
		public function getZonesByCountry($zoneCountry){
			$query_record = $this->db->select('Zone_Id,Zone_Name')->where(array('Zone_Country'=> $zoneCountry))->from('zone')->get()-> result_array();
			return $query_record;
		}
		public function getZoneById($zoneId){
			print_r($zoneId);
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