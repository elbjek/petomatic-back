<?php

namespace App\Controllers;

use App\Core\App;
header('Access-Control-Allow-Origin: *');
class PagesController
{
    public function home()
    {
        $customers = App::get('database')->getAllCustomers("appointments", "appointment_type", 
                                                        "appointment_type_id", "id", "pets", "pets_id",
                                                        "customers", "customers_id", $params['clientId']);
        echo json_encode($customers);
    }

        // public function home(){
        //     $customers = App::get('database')->getAll("customers");
        //     echo json_encode($customers);
        // }
}
