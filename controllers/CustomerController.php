<?php

namespace App\Controllers;

use App\Core\App;

header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Origin: *');

class CustomerController
{

    public function oneCustomer($params)
    {

        $customer = App::get('database')->getOne("appointments", "appointment_type", 
        "appointment_type_id", "id", "pets", "pets_id",
        "customers", "customers_id", $params['clientId']);
        echo json_encode($customer);
    }
    public function create()
    {
        $data = trim(file_get_contents("php://input"));
        $decoded = json_decode($data, true);
        $customers = App::get('database')->addNew('customers', $decoded);
    }

}