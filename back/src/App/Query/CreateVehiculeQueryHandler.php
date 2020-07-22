<?php


namespace App\App\Query;


use App\Domain\Entity\Vehicule;
use App\Domain\Entity\VehiculeRepositoryInterface;

class CreateVehiculeQueryHandler implements QueryHandlerInterface
{
  private $vehiculeRepository;

  public function __construct(VehiculeRepositoryInterface $vehiculeRepository)
  {
    $this->vehiculeRepository = $vehiculeRepository;
  }

  public function handle(QueryInterface $command)
  {
    $vehicule = new Vehicule($command->getIdentifier());
    $this->vehiculeRepository->create($vehicule);

    return $vehicule;
  }
}
