<?php


namespace App\App\Command;


interface CommandBusInterface
{
  public function handle(CommandInterface $command);

  public function getHandler(CommandInterface $command);

  public function register($name, CommandHandlerInternaface $handlerInternafece);

}
