<?php namespace Vimrcfu\Exceptions;

use Illuminate\Support\MessageBag;

class ValidationException extends \Exception {

  /*
   * @param Illuminate\Support\MessageBag $errors
   */
  protected $errors;

  /*
   * @param string $message
   * Illuminate\Support\MessageBag $errors
   */
  public function __construct($message, MessageBag $errors)
  {
    $this->errors = $errors;

    parent::__construct($message);
  }

  /*
   * @return Illuminate\Support\MessageBag
   */
  public function getErrors()
  {
    return $this->errors;
  }

}
