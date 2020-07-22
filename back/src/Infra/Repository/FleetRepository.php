<?php


namespace App\Infra\Repository;


use App\Domain\Entity\Fleet;
use App\Domain\Entity\FleetRepositoryInterface;
use App\Domain\Entity\Owner;
use App\Domain\Entity\Vehicule;

class FleetRepository implements FleetRepositoryInterface
{
  private $fleet;

  public function __construct($fleet = array())
  {
    $this->fleet = $fleet;
  }

  public function getFrom(Owner $owner): Fleet
  {
    foreach ($this->fleet as $fleet) {
      if ($fleet["owner"] == $owner->getName()) {
        return $fleet["fleet"];
      }
    }
    throw  new \Exception("Owner not registred");

  }

  public function all()
  {
    return $this->fleet;
  }

  public function register(Owner $owner, Fleet $fleet)
  {
    $this->fleet[] = [
      "owner" => $owner->getName(),
      "fleet" => $fleet
    ];
  }


}
