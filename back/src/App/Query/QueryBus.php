<?php


namespace App\App\Query;


use App\App\Command\CommandHandlerInternaface;

class QueryBus implements QueryBusInterface
{

  /**
   * @var QueryHandlerInterface[]
   */
  private $handlers = array();


  public function handle(QueryInterface $query)
  {
    $aggregateRoot = null;

    $commandHandler = $this->getHandler($query);
    $aggregateRoot = $commandHandler->handle($query);

    return $aggregateRoot;
  }

  public function getHandler(QueryInterface $query)
  {
    if (!array_key_exists($query->__toString(), $this->handlers)) {
      throw new \Exception(
        sprintf(
          'No handler defined for the command "%s". ',
          $query->__toString()
        ));
    }

    return $this->handlers[$query->__toString()];
  }

  public function register($commandName, QueryHandlerInterface $handler)
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
