<?php


namespace App\App\Command;


class CommandBus implements CommandBusInterface
{
  private $handlers = array();

  public function __construct(iterable $handlers)
  {
    foreach ($handlers as $handler) {
      $this->handlers[$handler->listenTo()] = $handler;
    }
  }

  public function handle(CommandInterface $command)
  {
    $commandHandler = $this->handlers[get_class($command)];
    $commandResponse = $commandHandler->handle($command);
    return $commandResponse;
  }

  public function getHandler(CommandInterface $command)
  {
    if (!array_key_exists($command->__toString(), $this->handlers)) {
      throw new \Exception(
        sprintf(
          'No handler defined for the command "%s". ',
          $command->__toString()
        ));
    }

    return $this->handlers[$command->__toString()];
  }

  public function register($commandName, CommandHandlerInternaface $handler)
  {
    if (array_key_exists($commandName, $this->handlers)) {
      throw new \Exception(
        sprintf(
          'A command handler has already been defined for the command "%s". ',
          $commandName
        ));
    }

    $this->handlers[$commandName] = $handler;
  }
}
