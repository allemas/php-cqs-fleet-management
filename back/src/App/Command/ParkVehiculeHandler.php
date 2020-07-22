<?php

namespace App\App\Command;


use App\App\Command\CommandHandlerInternaface;
use App\App\Command\CommandInterface;
use App\App\Command\CommandResponse;
use App\Domain\Entity\FleetRepositoryInterface;
use App\Infra\Repository\VehiculeRepository;

class ParkVehiculeHandler implements CommandHandlerInternaface
{

  private $vehiculeRepository;

  public function __construct(VehiculeRepository $fleetRepository)
  {
    $this->vehiculeRepository = $fleetRepository;
  }

  public function listenTo()
  {
    return ParkVehicule::class;
  }

  public function handle(CommandInterface $command): CommandResponse
  {
    $vehicule = $this->vehiculeRepository->getFrom($command->vehicule->getUid());

    $vehicule->park($command->location);

    return CommandResponse::withValue(true);
  }
}
