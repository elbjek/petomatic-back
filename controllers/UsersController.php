<?php

namespace App\Controllers;

use App\Core\App;
header('Access-Control-Allow-Origin: *');
class UsersController
{
    // public function login(){
    //     $data = trim(file_get_contents("php://input"));
    //     $decoded = json_decode($data, true);
    //     $email = $decoded['email'];
    //     $user = App::get('database')->getOneUser("users", $email);
    //     if(!$user){
    //         return false;
    //     }
        // $password = $this->hash($decoded);
        // dd($_SESSION['auth']);
        // if($password === $user->password) {
        //     $_SESSION['auth'] = $user;
        //     return redirect('/admin/events');
            
        // }else{
        //     return redirect('/admin/login');
        // }
    }
    // public function addUser(){
    //     $credentials = $_POST;
    //     $credentials['password'] = hashPassword($credentials);
    //     App::get('database')->addNew("users", $credentials);
    //     echo json_encode('sucess');
    //   }

    // public function create()
    // {
    //     $data = trim(file_get_contents("php://input"));
    //     $decoded = json_decode($data, true);
    //     $customers = App::get('database')->addNew('customers', $decoded);
    // }

