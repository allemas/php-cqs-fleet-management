<?php


namespace App\App\Query;


interface QueryBusInterface
{
  public function handle(QueryInterface $query);

  public function register($commandName, QueryHandlerInterface $handler);

  public function getHandler(QueryInterface $query);

}
