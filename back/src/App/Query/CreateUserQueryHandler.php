<?php


namespace App\App\Query;


use App\Domain\User\User;

class CreateUserQueryHandler implements QueryHandlerInterface
{

  public function handle(QueryInterface $command)
  {
    $user = new User($command->getUserName());
    return $user;
  }
}
