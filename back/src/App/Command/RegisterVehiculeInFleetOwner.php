<?php


namespace App\App\Command;


use App\App\Command\CommandInterface;
use App\Domain\Entity\Owner;
use App\Domain\Entity\Vehicule;

class RegisterVehiculeInFleetOwner implements CommandInterface
{

  public $owner;
  public $vehicule;

  public function __construct(Owner $owner, Vehicule $vehicule)
  {
    $this->owner = $owner;
    $this->vehicule = $vehicule;
  }

  public function __toString()
  {
    return __CLASS__;
  }
}
