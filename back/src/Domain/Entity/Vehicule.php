<?php


namespace App\Domain\Entity;



class Vehicule
{
  public $uid;
  private $name;


  public function __construct($name)
  {
    $date = new \DateTime();

    $this->uid = $name . $date->getTimestamp();
    $this->name = $name;
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
