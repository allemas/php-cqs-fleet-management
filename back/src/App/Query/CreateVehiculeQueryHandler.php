<?php


namespace App\App\Query;


use App\Domain\User\User;
use App\Domain\Vehicule\Vehicule;

class CreateVehiculeQueryHandler implements QueryHandlerInterface
{

  public function handle(QueryInterface $command)
  {
    return new Vehicule($command->getName());
  }
}
