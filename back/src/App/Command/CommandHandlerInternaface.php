<?php


namespace App\App\Command;


interface CommandHandlerInternaface
{
  public function listenTo();

  public function handle(CommandInterface $command): CommandResponse;
}
