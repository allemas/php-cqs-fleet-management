<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Owner;
use App\Domain\Entity\Vehicule;

interface FleetRepositoryInterface
{
  public function getFrom(Owner $owner): Fleet;

  public function all();

  public function register(Owner $owner, Fleet $fleet);

}
