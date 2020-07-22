<?php


namespace App\Infra\Repository;


use App\Domain\Entity\Vehicule;
use App\Domain\Entity\VehiculeRepositoryInterface;

class VehiculeRepository implements VehiculeRepositoryInterface
{
  private $vehicule = array();

  public function __construct()
  {
    $this->vehicule = array();
  }

  public function create(Vehicule $vehicule)
  {
    if (!array_key_exists($vehicule->getUid(), $this->vehicule)) {
      $this->vehicule[$vehicule->getUid()] = $vehicule;
    }

  }

  public function fetchAll()
  {
    return $this->vehicule;
  }

  public function getFrom($uid)
  {
    if (array_key_exists($uid, $this->vehicule)) {
      return $this->vehicule[$uid];
    }
  }

}
