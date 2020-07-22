<?php


namespace App\App\Query;


interface QueryHandlerInterface
{
  public function handle(QueryInterface $command);
}
