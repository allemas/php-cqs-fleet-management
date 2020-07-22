<?php

namespace App\App\Command;


use App\App\Command\CommandHandlerInternaface;
use App\App\Command\CommandInterface;
use App\App\Command\CommandResponse;

class GetUserFleetHandler implements CommandHandlerInternaface
{

  public function listenTo()
  {
    return GetUserFleet::class;
  }

  public function handle(CommandInterface $command): CommandResponse
  {
    return CommandResponse::withValue("coucouuuuu");
  }
}
