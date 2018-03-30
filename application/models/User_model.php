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
		public function getUsersByHouseId($houseId){
			$query = $this->db->get_where('users',array('houseId'=> $houseId));
			return $query -> result_array();
		}
		public function getHouse($houseId){
			$query = $this->db->get_where('houses',array('houseId'=> $houseId));
			return $query -> row_array();
		}
		public function registerUser($form_data){
			$query = $this->db->get_where('users',array('emailId'=> $form_data['emailId']));
			if($query->num_rows() > 0)
				return "user already exist";
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
		public function generateKey(){
			return rand(100000,999999);
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

		public function get_admin_email($houseId){
			$query=$this->db->query('select admin "emailId" from houses where houseId='.$houseId);
			return $query -> row_array();
		}

		public function get_house_users($houseId){
			$query=$this->db->query("select emailId from users where houseId=".$houseId);
			return $query -> result_array();
		}
		public function get_logs(){
			$query=$this->db->query("select * from logs order by logId desc");
			return $query -> result_array();
		}
	}