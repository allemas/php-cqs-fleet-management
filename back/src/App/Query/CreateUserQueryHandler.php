<?php


namespace App\App\Query;

use App\Domain\Entity\Owner;

class CreateUserQueryHandler implements QueryHandlerInterface
{

  public function handle(QueryInterface $command)
  {
    $user = new Owner($command->getUserName());
    return $user;
  }
}
