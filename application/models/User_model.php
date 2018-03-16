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
					$house=getHouse($form_data['houseId']);
					if($house!='' && $house['houseKey']==$form_data['houseKey']){
						$data = array(
						'userName'=>$form_data['userName'],
					 	'emailId'=>$form_data['emailId'],
					 	'password'=>md5($form_data['password']),
					 	'userType'=>$form_data['userType'],
					 	'houseId' =>$form_data['houseId']
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
		public function sendEmail($from_email,$from_name,$to_email,$subject,$message){
			$this->email->from($from_email, $from_name); 
        	$this->email->to($to_email);
        	$this->email->subject($subject); 
        	$this->email->message($message); 	
        	$this->email->send();
		}
	}