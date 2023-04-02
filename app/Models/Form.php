<?php

namespace App\Models;

use App\Model;

class Form extends Model
{
    // this model should have more attributes in the future, to fulfill all values coming from the form
    // for this project i've just used the necessary one
    protected string $postcode = '';
    protected int $bedrooms;
    protected string $type;

    public function __construct(string $postcode, int | string $bedrooms, string $type)
    {
        $this->postcode = $postcode; // would be beneficial in the future to validate postcode
        $this->bedrooms = $bedrooms;
        $this->type = $type;

    }

        public function rules(): array
    {
        return [

            'postcode' => [self::RULE_REQUIRED], // would be good to add postcode validation rule
            'bedrooms' => [self::RULE_REQUIRED],
            'type' => [self::RULE_REQUIRED] // would be good to add validation using array with allowed types

        ];
    }
}