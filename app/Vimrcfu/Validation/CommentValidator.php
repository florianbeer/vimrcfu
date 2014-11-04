<?php namespace Vimrcfu\Validation;

class CommentValidator extends Validator {

  /**
   * Rules for a Comment
   *
   * @var array
   */
  protected $rules = [
    'body' => 'required|min:4'
    ];

}
