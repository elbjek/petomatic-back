<?php

namespace App\Controllers;

use App\Core\App;

header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Origin: *');

class PetController
{
    public function breed()
    {
        $breed = App::get('database')->getAll('breed');
        echo json_encode($breed);
    }
    public function sex()
    {
        $breed = App::get('database')->getAll('sex');
        echo json_encode($breed);
    }
    public function species()
    {
        $breed = App::get('database')->getAll('species');
        echo json_encode($breed);
    }
    public function addPet()
    {
        $data = trim(file_get_contents("php://input"));
        $decoded = json_decode($data, true);
        $pets = App::get('database')->addNew('pets', $decoded);
    }
    public function allPets()
    {
        $pets = App::get('database')->getAll('pets');
        echo json_encode($pets);
    }
    public function update ($params)
    {
      $data = trim(file_get_contents("php://input"));
      $decoded = json_decode($data, true);
      App::get('database')->editPet('pets', $decoded, $params);
    }
    public function onePet ()
    {
        $pet = App::get('database')->getOnePet();
        echo json_encode($pet);
    }

}