<?php


namespace App\App\Query;


class CreateVehiculeQuery implements QueryInterface
{

  private $label;

  public function __construct($label)
  {
    $this->label = $label;

  }

  public function getName()
  {
    return $this->label;
  }

  public function __toString()
  {
    return __CLASS__;
  }
}
