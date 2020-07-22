<?php


namespace App\App\Command;


use App\App\Command\CommandInterface;
use App\Domain\Entity\Location;
use App\Domain\Entity\Owner;
use App\Domain\Entity\Vehicule;

class ParkVehicule implements CommandInterface
{

  public $location;
  public $vehicule;

  public function __construct(Location $location, Vehicule $vehicule)
  {
    $this->location = $location;
    $this->vehicule = $vehicule;
  }

  public function __toString()
  {
    return __CLASS__;
  }
}
