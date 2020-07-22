<?php


namespace App\Domain\Entity;


class Location
{
  private $uid;
  private $location;

  public function __construct($locationAd)
  {
    $date = new \DateTime();
    $this->uid = $locationAd . $date->getTimestamp() . $date->getTimestamp();
    $this->location = $locationAd;
  }


  /**
   * @return mixed
   */
  public function getLocation()
  {
    return $this->location;
  }

  /**
   * @return string
   */
  public function getUid(): string
  {
    return $this->uid;
  }


}
