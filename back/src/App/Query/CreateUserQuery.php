<?php


namespace App\App\Query;


class CreateUserQuery implements QueryInterface
{

  public function __construct($name)
  {
    $this->name = $name;

  }

  public function getUserName()
  {
    return $this->name;
  }

  public function __toString()
  {
    return __CLASS__;
  }
}
