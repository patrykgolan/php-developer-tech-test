<?php

namespace App\Models;

use App\Model;

class Form extends Model
{
private string $first_name;
private string $surname;
private string $email;
private string $phone;
private string $address_line_1;
private string $address_line_2;
private string $address_line_3;
private string $address_line_4;
private string $town;
private string $county;
private string $postcode;
private int $bedrooms;
private string $property_value;
private string $type;
private string $additional_information;
private string $compare;
public function rules(): array
{

}}