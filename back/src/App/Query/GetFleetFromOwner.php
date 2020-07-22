<?php


namespace App\App\Query;


class GetFleetFromOwner implements QueryInterface
{
  private $owner;

  public function __construct($owner)
  {
    $this->owner = $owner;
  }

  /**
   * @return mixed
   */
  public function getOwner()
  {
    return $this->owner;
  }


  public function __toString()
  {
    return __CLASS__;
  }
}
