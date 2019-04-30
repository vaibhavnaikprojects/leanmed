<?php
    class Orders extends CI_Controller{


        public function index(){

        }

        public function placeOrder(){

            if($this->UserModel->system_auth(false,false)==true){
                $resp=$this->OrdersModel->placeUserOrders();
                json_output($resp['status'],$resp);
            }
        }





    }
