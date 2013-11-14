# Abstraction

Abstraction for Laravel is designed to in-source all of your model validation to the model itself. 

## Features

Abstraction does one thing: validate your models for you! Simply define the `$rules` variable on your model, and extend the Abstraction model, and you're good to go!

## Requirements

Abstraction is built for Laravel, specifically `4.0.*`.

## Installation

To install Abstraction, simply add `"adamgoose/abstraction": "dev-master"` to your composer.json, and execute `composer update`.

## Usage

To utilize Abstraction on a model, extend `Adamgoose\Abstraction\Model` instead of `Eloquent`, like so:

    <?php

    use Adamgoose\Abstraction\Model;

    class Item extends Model {

    }

Once you're extending Abstraction, you can simply add your validtion rules to the model, like so:

      public static $rules = [
        // validation rules
        'name' => 'required',
      ];

You can also customize the validation messages:

      public static $messages = [
        // validation messages
        'name' => 'The Name field is required.'
      ];

When you're ready to save a model, you can do it in two ways:

### The Traditional Way

    $item = Item::find($id);
    $input = Input::all();

    $validation = $item->fill($input)->save() ?: $item->errors;

### The Abstraction Way

    $item = Item::find($id);
    $input = Input::all();

    $validation = $item->fillAndSave($input) ?: $item->errors;

Yes, the `fillAndSave(array $attributes)` method simply executes `fill(array $attributes)` and returns `save()`.

## Contributing

This package is a minimal package to streamline the validation process, potentially eliminating the need for Validation and/or Creation services. That being said, contributions to this package will be considered accordingly. Please feel free to submit issues and/or pull-requests if you think there is something that Abstraction could do better.