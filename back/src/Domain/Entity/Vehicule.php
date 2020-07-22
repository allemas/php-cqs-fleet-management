<?php


namespace App\Domain\Entity;


use PHPUnit\Util\Exception;

class Vehicule
{
  public $uid;
  private $name;

  /**
   * @var $location Location
   */
  private $location;


  public function __construct($name)
  {
    $date = new \DateTime();

    $this->uid = $name . $date->getTimestamp();
    $this->name = $name;
    $this->location = null;
  }

  public function park(Location $location)
  {
    if ($this->location != null && $this->location->getUid() == $location->getUid()) {
      throw new Exception("Already parked");
    }

    if ($this->location === null) {
      $this->location = $location;
    }
  }

  public function getLocation()
  {
    if ($this->location != null) {
      return $this->location;
    }
    throw new Exception("Vehicule " . $this->getUid() . " not parked");
  }


  /**
   * @return string
   */
  public function getUid(): string
  {
    return $this->uid;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }


}
