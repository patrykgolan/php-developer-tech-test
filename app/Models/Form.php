<?php

namespace App\Models;

use App\Model;

class Form extends Model
{
protected string $postcode = '';
protected int $bedrooms;
private string $property_value = '';
protected string $type;
private string $additional_information = '';

public function __construct(string $postcode, int | string $bedrooms, string $type)
{
    $this->postcode = $postcode;
    $this->bedrooms = $bedrooms;
    $this->type = $type;

}

    public function rules(): array
{
    return [

        'postcode' => [self::RULE_REQUIRED],
        'bedrooms' => [self::RULE_REQUIRED],
        'type' => [self::RULE_REQUIRED]

    ];
}
}