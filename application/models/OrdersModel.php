<?php

class OrdersModel extends CI_Model
{
    /*
      "patientDetails": {
                       "Patient_Id":"",
                       "Patient_FName":"",
                       "Patient_LName":"",
                       "Patient_Id":"",
                       "Patient_DOB":"",
                       "Patient_Contact":"",
                       "Patient_Email":"",
                       "Patient_Address":"",
                       "Patient_State":"",
                       "Patient_City":"",
                       "Patient_Country":""
                   },

      "orderDetails": {

                       "Order_Date":"",
                       "Prescription_Image":"",
                       "Confirmation_Image":"",
                       "Zone_Id":"",
                       "User_Email":"",
                       "Patient_Id":"",
                       "Prescription_Image":"",
                       "requests":{"Inventory_Id_1": {
                                                          "Medicine_Id":quantity_value(int)
                                                    },
                                    "Inventory_Id_2": {
                                                          "Medicine_Id":quantity_value(int)
                                                    }
                                  }


     */

    public function placeUserOrders()
    {
        $orderDetails = json_decode(file_get_contents('php://input'), true);
//        return array('status' => 200, 'message' => $orderDetails);
        $this->beginTransaction();
        $patientID = $this->addPatientDetailsToPatients($orderDetails["patientDetails"]);
        $orderDetails["orderDetails"]["Patient_Id"] = $patientID;
        $this->addOrderDetailToOrder($orderDetails["orderDetails"]);
        $this->updateRequestTables($orderDetails);
        return $this->completeTransaction($patientID);


    }

    private function addPatientDetailsToPatients($patientDetails)
    {
        if ($this->isPatientDetailExistInDB($patientDetails)) {
            return $patientDetails["Patient_Id"];
        } else {
            $newPatientDetails = $this->getInsertDetails($patientDetails);
            $this->db->insert("patient", $newPatientDetails);
            return $this->getPatientID();
        }
    }

    private function addOrderDetailToOrder($orderDetails)
    {
        $newOrderDetails = $this->getOrderDetails($orderDetails);
        $this->db->insert("orders", $newOrderDetails);
        $orderDetails["Order_Id"] = $this->getOrderId();
        $orderDetails["Prescription_Image"] = $this->addImageToServer($orderDetails);
        $this->updateImageLocation($orderDetails);

    }

    private function isPatientDetailExistInDB($patientDetails)
    {
        if ($patientDetails["Patient_Id"] != null) {
            $patId = $patientDetails['Patient_Id'];
            $this->db->select("*");
            $this->db->from("patient");
            $this->db->where("Patient_Id = $patId");
            if ($this->db->get()->num_rows() == 1)
                return true;
            else
                return false;

        } else {
            return false;
        }
    }

    private function getInsertDetails($array)
    {
        $newArray = array();
        foreach (array_keys($array) as $key) {
            $newArray[$key] = $array[$key];
        }
        return $newArray;
    }

    private function getOrderDetails($orderDetails)
    {
        $array = array(
            "Order_Id" => $orderDetails["Order_Id"],
            "Order_Date" => $orderDetails["Order_Date"],
            "Receiving_Date" => null,
            "Prescription_Image" => "/",
            "Order_Status" => 2,
            "Confirmation_Image" => null,
            "Zone_Id" => $orderDetails["Zone_Id"],
            "User_Email" => $orderDetails["User_Email"],
            "Patient_Id" => $orderDetails["Patient_Id"]
        );
        return $array;
    }

    private function updateRequestTables($orderDetails)
    {
        foreach (array_keys($orderDetails["orderDetails"]["requests"]) as $inventoryID) {
            $insertDetails = $this->getRequestDetails($orderDetails, $inventoryID);
            $this->db->insert("request", $insertDetails);
//            $this->updateInventoryTable($orderDetails["orderDetails"][$inventoryID], $inventoryID);
        }

    }

    private function updateInventoryTable($orderDetails, $inventoryID)
    {
        $recordQuantity = $this->getCurrentQuantityFromInventory($inventoryID);
        $requiredQuantity = $orderDetails[$inventoryID]["Quantity"];
        $newQuantityVal = array("Quantity" => $recordQuantity - $requiredQuantity);
        $this->db->where('Inventory_Id', $inventoryID);
        $this->db->update("inventory", $newQuantityVal);

    }

    private function getRequestDetails($orderDetails, $inventoryID)
    {
        $array = array(
            "Medicine_Id" => $orderDetails["orderDetails"]["requests"][$inventoryID]["Medicine_Id"],
            "Order_Id" => $orderDetails["orderDetails"]["Order_Id"],
            "Comments" => null,
            "Zone_Id" => $orderDetails["orderDetails"]["Zone_Id"],
            "Status" => 2,
            "Created_date" => $orderDetails["orderDetails"]["Order_Date"],
            "Modified_Date" => $orderDetails["orderDetails"]["Order_Date"],
            "Created_User" => $orderDetails["orderDetails"]["User_Email"],
            "Accepted_User" => null,
            "Quantity" => $orderDetails["orderDetails"]["requests"][$inventoryID]["Quantity"]
        );
        return $array;
    }

    private function getCurrentQuantityFromInventory($inventoryID)
    {
        $this->db->select('Quantity');
        $this->db->from('inventory');
        $this->db->where('Inventory_Id', $inventoryID);
        return $this->db->get()->row()->Quantity;
    }

    private function getPatientID()
    {
        $this->db->select_max('Patient_Id');
        $result = $this->db->get('patient')->row();
        return $result->Patient_Id;
    }

    private function getOrderId()
    {
        $this->db->select_max('Order_Id');
        $result = $this->db->get('orders')->row();
        return $result->Order_Id;
    }

    private function addImageToServer($orderDetails)
    {
        $orderID = $orderDetails["Order_Id"];
//        $patientID = $orderDetails["Patient_Id"];
        $fileName = "~/LeanMed/prescription_img/".$orderID;
        file_put_contents($fileName, base64_decode($orderDetails["Prescription_Image"]));
        return $fileName;
    }

    private function updateImageLocation($orderDetails)
    {
        $new_data = array("Prescription_Image"=> $orderDetails["Prescription_Image"]);
        $this->db->where('Order_Id', $orderDetails["Order_Id"]);
        $this->db->update("orders", $new_data);
        return;
    }

    private function beginTransaction()
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(true); # See Note 01. If you wish can remove as well
    }

    private function completeTransaction($patientID)
    {
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return array('status' => 400, 'message' => 'transaction error');
        }
        else {
            # Everything is Perfect.
            # Committing data to the database.
            $this->db->trans_commit();
            return array('status' => 200, 'message' => 'success', "Patient_Id"=>$patientID);
        }
    }


}