<?php

namespace App\Controllers;

use App\Core\App;

header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Origin: *');

class CustomerController
{
    //customer table
    public function allCustomers()
    {
        $customer = App::get('database')->getAll('customers');
        echo json_encode($customer);
    }

    public function oneCustomer($params)
    {
        $customer = App::get('database')->getOne("appointments", "appointment_type", 
        "appointment_type_id", "id", "pets", "pets_id",
        "customers", "customers_id","breed", "breed_id", "species", "species_id", "sex","sex_id", $params);
        echo json_encode($customer);
    }
    // create new customer 
    public function create()
    {
        $data = trim(file_get_contents("php://input"));
        $decoded = json_decode($data, true);
        $customers = App::get('database')->addNew('customers', $decoded);
    }
    public function allData()
    {
        $customers = App::get('database')->getAllCustomers("appointments", "appointment_type", 
                                                        "appointment_type_id", "id", "pets", "pets_id",
                                                        "customers", "customers_id");
        echo json_encode($customers);
    }
    public function update ($params)
    {
      $data = trim(file_get_contents("php://input"));
      $decoded = json_decode($data, true);
      App::get('database')->editClient('customers', $decoded, $params);
    }

    public function delete ()
    {
        $data = trim(file_get_contents("php://input"));
        dd($data);
        $decoded = json_decode($data, true);
        App::get('database')->update('customers',$decoded);
    }

}