<?php


namespace App\Domain\Entity;


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
      throw new \Exception("Vehicule already registred");
    }

    $this->vehicules[$vehiculeAdded->getUid()] = $vehiculeAdded;
  }

  public function toArray()
  {
    return $this->vehicules;
  }

}
