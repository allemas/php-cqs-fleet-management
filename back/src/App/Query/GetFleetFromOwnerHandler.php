<?php


namespace App\App\Query;


use App\Domain\Entity\Fleet;
use App\Domain\Entity\FleetRepositoryInterface;
use App\Infra\Repository\FleetRepository;

class GetFleetFromOwnerHandler implements QueryHandlerInterface
{

  private $fleetRepository;

  public function __construct(FleetRepositoryInterface $fleetRepository)
  {
    $this->fleetRepository = $fleetRepository;
  }

  public function handle(QueryInterface $command)
  {
    $owner = $command->getOwner();
    $fleet = $this->fleetRepository->getFrom($owner);
    return $fleet;
  }
}
