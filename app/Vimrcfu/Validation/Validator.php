<?php namespace Vimrcfu\Validation;

use Vimrcfu\Exceptions\ValidationException;
use Illuminate\Validation\Factory as IlluminateValidator;

abstract class Validator {

  /**
   * @var Illuminate\Validation\Factory
   */
  protected $validator;

  /**
   * @var mixed
   */
  protected $validation;

  /**
   * @param Illuminate\Validation\Factory $validator
   */
  public function __construct(IlluminateValidator $validator)
  {
    $this->validator = $validator;
  }

  /**
   * @param array $data
   * @throws Vimrcfu\Exceptions\ValidationException
   */
  public function validate(array $data)
  {
    $this->validation = $this->validator->make($data, $this->getRules());

    if ($this->validation->fails())
    {
      throw new ValidationException('Validation failed', $this->getErrors());
    }

    return true;
  }

  /**
   * @return array
   */
  protected function getRules()
  {
    return $this->rules;
  }

  /**
   * @return mixed
   */
  protected function getErrors()
  {
    return $this->validation->errors();
  }

}
