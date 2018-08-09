<?php

$router->get('all', 'CustomerController@allData');

//Create,Read,Update and Delete multiple and single customers

$router->post('customers/create', 'CustomerController@create');
$router->get('customers/{clientId}', 'CustomerController@oneCustomer');
$router->get('customers', 'CustomerController@allCustomers');
$router->post('customers/edit/{clientId}', 'CustomerController@update');
$router->post('customers/delete/{clientId}', 'CustomerController@delete');


//PETS 
$router->post('pets/create', 'PetController@addPet');
$router->get('pets/breed', 'PetController@breed');
$router->get('pets/sex', 'PetController@sex');
$router->get('pets/species', 'PetController@species');
$router->get('pets', 'PetController@allPets');


$router->get('appointments/types', 'AppointmentController@appointmentTypes');
$router->post('appointments/create', 'AppointmentController@create');
$router->get('appointments/all', 'AppointmentController@allAppointments');

//Get multiple and single users

$router->post('signup', 'Authenticate@createuser');



