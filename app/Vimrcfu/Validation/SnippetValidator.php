<?php namespace Vimrcfu\Validation;

class SnippetValidator extends Validator {

  /**
   * Rules for a Snippet
   *
   * @var array
   */
  protected $rules = [
    'title' => 'required|min:4',
    'body' => 'required',
    'description' => 'required'
    ];

}
