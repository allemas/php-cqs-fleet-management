<?php


namespace App\App\Query;


class CreateVehiculeQuery implements QueryInterface
{

  private $identifier;

  public function __construct($label)
  {
    $this->identifier = $label;

  }

  public function getIdentifier()
  {
    return $this->identifier;
  }

  public function __toString()
  {
    return __CLASS__;
  }
}
