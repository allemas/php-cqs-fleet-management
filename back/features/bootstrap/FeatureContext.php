<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
  private $owner;
  private $myFleet;
  private $vehicule;


  private $commandBus;
  private $queryBus;
  private $fleetOwnerAgregate;
  private $vehiculeRepository;

  public function __construct()
  {
    $this->owner = new \App\Domain\Entity\Owner("john");


    $johnFleet = new \App\Domain\Entity\Fleet();
    $johnFleet->add(new \App\Domain\Entity\Vehicule("Vehicule_A"));

    $fleetFixture = [
      "owner" => $this->owner->getName(),
      "fleet" => $johnFleet
    ];

    $fleetRepository = new \App\Infra\Repository\FleetRepository([$fleetFixture]);
    $this->vehiculeRepository = new \App\Infra\Repository\VehiculeRepository();

    $this->queryBus = new \App\App\Query\QueryBus();
    $this->queryBus->register(\App\App\Query\GetFleetFromOwner::class, new \App\App\Query\GetFleetFromOwnerHandler($fleetRepository));
    $this->queryBus->register(\App\App\Query\CreateUserQuery::class, new \App\App\Query\CreateUserQueryHandler());
    $this->queryBus->register(\App\App\Query\CreateVehiculeQuery::class, new \App\App\Query\CreateVehiculeQueryHandler($this->vehiculeRepository));

    $this->commandBus = new \App\App\Command\CommandBus([
      new \App\App\Command\RegisterVehiculeInFleetOwnerHandler($fleetRepository),
      new \App\App\Command\ParkVehiculeHandler($this->vehiculeRepository)
    ]);

    $this->fleetOwnerAgregate = new \App\Domain\Agregate\FleetOwnerAgregate($fleetRepository);

  }

  /**
   * @Given my fleet
   */
  public function myFleet()
  {
    $this->myFleet = $this->fleetOwnerAgregate->getOwnerFleet($this->owner);

    \PHPUnit\Framework\assertInstanceOf(
      \App\Domain\Entity\Fleet::class,
      $this->myFleet
    );
  }

  /**
   * @Given a vehicle
   */
  public function aVehicle()
  {
    $this->vehicule = $this->queryBus->handle(new \App\App\Query\CreateVehiculeQuery("Vehicule_B"));
  }

  /**
   * @When I register this vehicle into my fleet
   */
  public function iRegisterThisVehicleIntoMyFleet()
  {

    try {
      $this->commandBus->handle(new \App\App\Command\RegisterVehiculeInFleetOwner($this->owner, $this->vehicule));
    } catch (Exception $e) {

    }

  }

  /**
   * @Then this vehicle should be part of my vehicle fleet
   */
  public function thisVehicleShouldBePartOfMyVehicleFleet()
  {
    $ownerFleet = $this->fleetOwnerAgregate->getOwnerFleet($this->owner);
    \PHPUnit\Framework\assertArrayHasKey($this->vehicule->getUid(), $ownerFleet->toArray());
  }

  /**
   * @Given I have registered this vehicle into my fleet
   */
  public function iHaveRegisteredThisVehicleIntoMyFleet()
  {
    $this->commandBus->handle(new \App\App\Command\RegisterVehiculeInFleetOwner($this->owner, $this->vehicule));

    $ownerFleet = $this->fleetOwnerAgregate->getOwnerFleet($this->owner);
    \PHPUnit\Framework\assertArrayHasKey($this->vehicule->getUid(), $ownerFleet->toArray());
  }

  private $exception;

  /**
   * @When I try to register this vehicle into my fleet
   */
  public function iTryToRegisterThisVehicleIntoMyFleet()
  {
    try {
      $this->commandBus->handle(new \App\App\Command\RegisterVehiculeInFleetOwner($this->owner, $this->vehicule));
    } catch (Exception $e) {
      $this->exception = $e;
    }
  }

  /**
   * @Then I should be informed this this vehicle has already been registered into my fleet
   */
  public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
  {
    \PHPUnit\Framework\assertInstanceOf(Exception::class, $this->exception);
    \PHPUnit\Framework\assertEquals("Vehicule already registred", $this->exception->getMessage());
  }


  private $fleetOfAnotherUser;
  private $anotherUser;

  /**
   * @Given the fleet of another user
   */
  public function theFleetOfAnotherUser()
  {
    $this->anotherUser = new \App\Domain\Entity\Owner("john");
    try {
      $this->fleetOwnerAgregate->create($this->anotherUser);
    } catch (Exception $e) {
    }
  }

  /**
   * @Given this vehicle has been registered into the other user's fleet
   */
  public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet()
  {

    try {
      $this->commandBus->handle(new \App\App\Command\RegisterVehiculeInFleetOwner($this->anotherUser, $this->vehicule));
      $fleet = $this->fleetOwnerAgregate->getOwnerFleet($this->anotherUser);
    } catch (Exception $e) {
    }

    $ownerFleet = $this->fleetOwnerAgregate->getOwnerFleet($this->anotherUser);
    \PHPUnit\Framework\assertArrayHasKey($this->vehicule->getUid(), $ownerFleet->toArray());
  }


  private $location;

  /**
   * @Given a location
   */
  public function aLocation()
  {
    $this->location = new \App\Domain\Entity\Location("my_locate");

    \PHPUnit\Framework\assertInstanceOf(\App\Domain\Entity\Location::class, $this->location);
  }

  /**
   * @When I park my vehicle at this location
   */
  public function iParkMyVehicleAtThisLocation()
  {
    $this->commandBus->handle(new \App\App\Command\ParkVehicule($this->location, $this->vehicule));
    \PHPUnit\Framework\assertInstanceOf(\App\Domain\Entity\Location::class, $this->vehicule->getLocation());
  }

  /**
   * @Then the known location of my vehicle should verify this location
   */
  public function theKnownLocationOfMyVehicleShouldVerifyThisLocation()
  {
    \PHPUnit\Framework\assertEquals($this->location->getUid(), $this->vehicule->getLocation()->getUid());
  }

  /**
   * @Given my vehicle has been parked into this location
   */
  public function myVehicleHasBeenParkedIntoThisLocation()
  {
    $this->commandBus->handle(new \App\App\Command\ParkVehicule($this->location, $this->vehicule));
  }


  /**
   * @When I try to park my vehicle at this location
   */
  public function iTryToParkMyVehicleAtThisLocation()
  {
    try {
      $this->commandBus->handle(new \App\App\Command\ParkVehicule($this->location, $this->vehicule));
    }catch (\Exception $exception){
      $this->exception = $exception->getMessage();
    }
  }

  /**
   * @Then I should be informed that my vehicle is already parked at this location
   */
  public function iShouldBeInformedThatMyVehicleIsAlreadyParkedAtThisLocation()
  {
    \PHPUnit\Framework\assertEquals($this->exception, "Already parked");

  }
}
