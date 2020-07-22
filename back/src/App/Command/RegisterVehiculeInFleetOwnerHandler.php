<?php

namespace App\App\Command;


use App\App\Command\CommandHandlerInternaface;
use App\App\Command\CommandInterface;
use App\App\Command\CommandResponse;
use App\Domain\Entity\FleetRepositoryInterface;

class RegisterVehiculeInFleetOwnerHandler implements CommandHandlerInternaface
{

  private $fleetRepository;

  public function __construct(FleetRepositoryInterface $fleetRepository)
  {
    $this->fleetRepository = $fleetRepository;
  }

  public function listenTo()
  {
    return RegisterVehiculeInFleetOwner::class;
  }

  public function handle(CommandInterface $command): CommandResponse
  {
    $ownerFleet = $this->fleetRepository->getFrom($command->owner);
    $ownerFleet->add($command->vehicule);

    return CommandResponse::withValue(true);
  }
}
