<?php


namespace App\App\Query;


use App\Domain\Entity\Vehicule;

class CreateVehiculeQueryHandler implements QueryHandlerInterface
{

  public function handle(QueryInterface $command)
  {


    return new Vehicule($command->getIdentifier());
  }
}
