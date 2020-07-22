<?php


namespace App\Domain\User;


use App\Domain\Vehicule\Vehicule;

class Fleet
{
  private $vehicules;


  public function __construct()
  {
    $this->vehicules = array();
  }

  public function add(Vehicule $vehiculeAdded)
  {
    if (in_array($vehiculeAdded, $this->vehicules)) {
      throw new AlreadyRegistredVehicule("Vehicule already registred");
    }

    $this->vehicules[] = $vehiculeAdded;
  }

  public function toArray()
  {
    return $this->vehicules;
  }

}
