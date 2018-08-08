<?php

namespace App\Controllers;

use App\Core\App;

header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Origin: *');

class AppointmentController
{

    public function appointmentTypes()
    {
        $appointments = App::get('database')->getAll('appointment_type');
        echo json_encode($appointments);
    }
    public function create()
    {
        $data = trim(file_get_contents("php://input"));
        $decoded = json_decode($data, true);
        $pets = App::get('database')->addNew('appointments', $decoded);
    }
    public function allAppointments()
    {
        $appointments = App::get('database')->getThreeAppointments("appointments", "appointment_type", 
                                                        "appointment_type_id", "id", "pets", "pets_id",
                                                        "customers", "customers_id");
        echo json_encode($appointments);
    }

}