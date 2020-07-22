<?php


namespace App\App\Command;


class CommandResponse
{
  public $value;
  public $events = array();


  public function __construct($value)
  {
    $this->value = $value;
  }

  public static function withValue($value): CommandResponse
  {
    $response = new CommandResponse($value);
    return $response;
  }


}
