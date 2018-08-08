<?php
 
namespace App\Controllers;
use \App\Core\App;
header('Access-Control-Allow-Origin: *');
class Authenticate {


    public function createuser(){

        $data = trim(file_get_contents("php://input"));
        $decoded = json_decode($data, true);
        $decoded['password'] = $this->hash($decoded);
        $customers = App::get('database')->addNew('users', $decoded);
    }

    public function validate(){

        $data = trim(file_get_contents("php://input"));
        $decoded = json_decode($data, true);
        $email = $decoded['email'];
        $user = App::get('database')->getOneUser("users", $email);
        if(!$user){
            return false;
        }    
        $password = $this->hash($decoded);
        if($password === $user->password) {

        }else{
            return redirect('/admin/login');
        }
    }
    private function hash($credentials){
        $password = $credentials['password'];
        $password = crypt($password, '$1$rasmusle$') . "\n";
        return $password; 
    }

    public function logout()
    {
        unset($_SESSION["auth"]);
        return redirect('/');
    }

}