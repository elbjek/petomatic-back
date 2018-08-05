<?php

$router->get('', 'PagesController@home');

//Create,Read,Update and Delete multiple and single customers

$router->get('customers/{clientId}', 'CustomerController@oneCustomer');
$router->post('customers/create', 'CustomerController@create');
//Get multiple and single users

$router->post('signup', 'Authenticate@createuser');



