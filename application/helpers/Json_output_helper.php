<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function json_output($statusHeader,$response){
		$ci =& get_instance();
		$ci->output->set_content_type('application/json');
		$ci->output->set_status_header($statusHeader);
		$ci->output->set_output(json_encode($response));
	}

	function allUsersOutput($users){
		$usersArr=array();
		foreach ($users as $user) {
		    $usersArr[]=userOutput($user);
		}
		return $usersArr;
	}

	function userOutput($user){
		$userArr=array();
		$userArr['userName']=$user['User_Name'];
		$userArr['emailId']=$user['User_Email'];
		$userArr['leanIDF']=$user['LeanId_F'];
		$userArr['leanIDAddress']=$user['IDLeanF_Address'];
		$userArr['identity']=$user['Identity_Card'];
		$userArr['userAddress']=$user['User_Address'];
		$userArr['city']=$user['User_City'];
		$userArr['state']=$user['User_State'];
		$userArr['country']=$user['User_Country'];
		$userArr['type']=$user['User_Type'];
		$userArr['userStatus']=$user['User_Status'];
		$userArr['languagePref']=$user['Language_Pref'];
		$userArr['zone']=zoneOutput($user);
		$userArr['contacts']=$user['Phone'];
		return $userArr;
	}
	function allZoneOutput($zones){
		$zonesArr=array();
		foreach ($zones as $zone) {
		    $zonesArr[]=zoneOutput($zone);
		}
		return $zonesArr;
	}

	function zoneOutput($zoneArr){
		$zone=array();
		if (array_key_exists("Zone_Id",$zoneArr))
			$zone['zoneId']=$zoneArr['Zone_Id'];
		if (array_key_exists("zone",$zoneArr))
			$zone['zone']=$zoneArr['zone'];
		if (array_key_exists("Zone_Name",$zoneArr))
			$zone['zoneName']=$zoneArr['Zone_Name'];
		if (array_key_exists("Zone_Email",$zoneArr))
			$zone['zoneEmail']=$zoneArr['Zone_Email'];
		if (array_key_exists("Zone_Country",$zoneArr))
			$zone['zoneCountry']=$zoneArr['Zone_Country'];
		return $zone;
	}
	function medicineOutput($medicineArr){
		$medicine=array();
		if (array_key_exists("Medicine_Id",$medicineArr))
			$medicine['medicineId']=$medicineArr['Medicine_Id'];
		if (array_key_exists("Generic_Name",$medicineArr))
			$medicine['genName']=$medicineArr['Generic_Name'];
		if (array_key_exists("Trade_Name",$medicineArr))
			$medicine['tradeName']=$medicineArr['Trade_Name'];
		if (array_key_exists("Medicine_Type",$medicineArr))
			$medicine['medicineType']=$medicineArr['Medicine_Type'];
		if (array_key_exists("Dosage",$medicineArr))
			$medicine['dosage']=$medicineArr['Dosage'];
		if (array_key_exists("Weight",$medicineArr))
			$medicine['weight']=$medicineArr['Weight'];
		return $medicine;
	}
	function inventoriesOutput($inventoryObjs){
		$inventoryArr=array();
		foreach ($inventoryObjs as $inventory) {
		    $inventoryArr[]=inventoryOutput($inventory);
		}
		return $inventoryArr;
	}
	function inventoryOutput($inventory){
		$inventoryArr=array();
		if (array_key_exists("Inventory_Id",$inventory))
			$inventoryArr['inventoryId']=$inventory['Inventory_Id'];
		if (array_key_exists("Units",$inventory))
			$inventoryArr['units']=$inventory['Units'];
		if (array_key_exists("ID_Box",$inventory))
			$inventoryArr['idBox']=$inventory['ID_Box'];
		if (array_key_exists("Exp_Date",$inventory))
			$inventoryArr['expiryDate']=$inventory['Exp_Date'];
		if (array_key_exists("Zone_Id",$inventory)){
			$zone=zoneOutput($inventory);
			$inventoryArr['zone']=$zone;
		}
		if (array_key_exists("Medicine_Id",$inventory)){
			$medicine=medicineOutput($inventory);
			$inventoryArr['medicine']=$medicine;
		}
		return $inventoryArr;
	}