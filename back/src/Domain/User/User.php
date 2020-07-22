<?php

namespace App\Domain\User;

class User
{
  private $name;

  public function __construct($name)
  {
    $this->name = $name;
    $this->fleet = new Fleet();
  }

  public function getFleet()
  {
    return $this->fleet;
  }


}
