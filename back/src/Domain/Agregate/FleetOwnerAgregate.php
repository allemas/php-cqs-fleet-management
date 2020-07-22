<?php


namespace App\Domain\Agregate;


use App\Domain\Entity\Fleet;
use App\Domain\Entity\FleetRepositoryInterface;
use App\Domain\Entity\Owner;

class FleetOwnerAgregate
{
  private $fleetRepository;

  public function __construct(FleetRepositoryInterface $fleetRepository)
  {
    $this->fleetRepository = $fleetRepository;
  }


  public function create(Owner $owner)
  {
    $emptyFleet = new Fleet();
    $this->fleetRepository->register($owner, $emptyFleet);
  }


  public function getOwnerFleet(Owner $owner): Fleet
  {
    return $this->fleetRepository->getFrom($owner);
  }

}
