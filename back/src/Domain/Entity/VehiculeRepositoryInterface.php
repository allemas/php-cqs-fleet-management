<?php


namespace App\Domain\Entity;


interface VehiculeRepositoryInterface
{
  public function fetchAll();

  public function getFrom($uid);

}
