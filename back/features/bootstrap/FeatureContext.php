<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;


//
//   ➜  back vendor/bin/behat --dry-run --append-snippets
//

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
  private $user;
  private $vehicule;


  private $commandBus;
  private $queryBus;

  public function __construct()
  {
    $this->queryBus = new \App\App\Query\QueryBus();
    $this->queryBus->register(\App\App\Query\CreateUserQuery::class, new \App\App\Query\CreateUserQueryHandler());
    $this->queryBus->register(\App\App\Query\CreateVehiculeQuery::class, new \App\App\Query\CreateVehiculeQueryHandler());




    $this->commandBus = new \App\App\Command\CommandBus([
      new \App\App\Command\GetUserFleetHandler()
    ]);




  }

  /**
   * @Given my fleet
   */
  public function myFleet()
  {
    $this->user = $this->queryBus->handle(new \App\App\Query\CreateUserQuery("john"));

  }

  /**
   * @Given a vehicle
   */
  public function aVehicle()
  {
    $vehicule = $this->queryBus->handle(new \App\App\Query\CreateVehiculeQuery("toyota"));
    $this->vehicule = $vehicule;
  }

  /**
   * @When I register this vehicle into my fleet
   */
  public function iRegisterThisVehicleIntoMyFleet()
  {
    $this->user->getFleet()->add($this->vehicule);
  }

  /**
   * @Then this vehicle should be part of my vehicle fleet
   */
  public function thisVehicleShouldBePartOfMyVehicleFleet()
  {
    \PHPUnit\Framework\assertEquals(
      $this->user->getFleet()->toArray(),
      [$this->vehicule]
    );

  }

  /**
   * @Given I have registered this vehicle into my fleet
   */
  public function iHaveRegisteredThisVehicleIntoMyFleet()
  {
    $this->user->getFleet()->add($this->vehicule);

    \PHPUnit\Framework\assertEquals(
      $this->user->getFleet()->toArray(),
      [$this->vehicule]
    );


  }

  /**
   * @When I try to register this vehicle into my fleet
   */
  public function iTryToRegisterThisVehicleIntoMyFleet()
  {
    try {
      $this->user->getFleet()->add($this->vehicule);
    } catch (Exception $e) {
    }


  }

  /**
   * @Then I should be informed this this vehicle has already been registered into my fleet
   */
  public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet()
  {

    try {
      $this->user->getFleet()->add($this->vehicule);
    } catch (Exception $e) {
      \PHPUnit\Framework\assertEquals(
        "Vehicule already registred",
        $e->getMessage()
      );
    }

  }


  private $fleetOfAnotherUser;

  /**
   * @Given the fleet of another user
   */
  public function theFleetOfAnotherUser()
  {
    $user = $this->queryBus->handle(new \App\App\Query\CreateUserQuery("john"));
    $this->fleetOfAnotherUser = $user->getFleet();
  }

  /**
   * @Given this vehicle has been registered into the other user's fleet
   */
  public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet()
  {
    $this->fleetOfAnotherUser->add($this->vehicule);


  }
}
