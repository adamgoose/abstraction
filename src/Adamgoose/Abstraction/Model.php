<?php namespace Adamgoose\Abstraction;

use Eloquent;
use Validator;
use Illuminate\Support\MessageBag;

abstract class Model extends Eloquent {

  /**
   * Model-specific Validation Rules
   *
   * @var array
   */
  public static $rules = array();

  /**
   * Model-specific Validation Messages
   *
   * @var array
   */
  public static $messages = array();

  /**
   * Validation errors
   *
   * @var Illuminate\Support\MessageBag
   */
  public $errors;

  /**
   * Create a new Abstract\Model
   *
   * @param array  $attributes
   * 
   * @return void
   */
  public function __construct(array $attributes = array())
  {
    parent::__construct($attributes);

    $this->errors = new MessageBag;
  }

  /**
   * Fill the model with attributes, and attempt to save
   *
   * @return mixed
   */
  public function fillAndSave(array $attributes = array())
  {
    $this->fill($attributes);
    return $this->save();
  }

  /**
   * Boot the model
   *
   * @return void
   */
  public static function boot()
  {
    parent::boot();

    static::saving(function($model)
    {
      return $model->validate();
    });
  }

  /**
   * Validate the model
   *
   * @return boolean
   */
  public function validate()
  {
    if(static::$rules) {

      $validator = Validator::Make($this->attributes, static::$rules, static::$messages);

      if ($validator->fails()) {
        $this->errors = $validator->messages();
        return false;
      }

      $validator->passes();

    }

    return true;
  }

  /**
   * Get the rules of the Model
   *
   * @return array
   */
  public static function getRules()
  {
    return static::$rules;
  }


}