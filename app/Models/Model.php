<?php

namespace App\Models;

use app\core\Application;

abstract class Model
{
    // rules/validations
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';

    // error attribute which later can be used to conditionally return appropriate views and error message for user
    public array $errors = [];

    // method will set whioch rules should be applied for the model
    abstract public function rules(): array;


    public function validate(): bool
    {

        foreach ($this->rules() as $attribute => $rules) {

            // get rules
            $value = $this->{$attribute};

            foreach ($rules as $rule) {

                $ruleName = $rule;

                if (!is_string($ruleName)) {

                    $ruleName = $rule[0];

                }
                // check rule by rule and add error if not valid

                if ($ruleName === self::RULE_REQUIRED && !$value) {

                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);

                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {

                    $this->addErrorForRule($attribute, self::RULE_EMAIL);

                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {

                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);

                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {

                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);

                }

            }
        }

        // check if there's any errors
        return empty($this->errors);
    }

    private function addErrorForRule(string $attribute, string $rule, $params = []): void
    {

        // add error to model
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value) {

            $message = str_replace("{{$key}}", $value, $message);

        }

        $this->errors[$attribute][] = $message;

    }


    public function errorMessages(): array
    {
        // render error messages
        return [

            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email',
            self::RULE_MIN => 'This field must be longer then {min}',
            self::RULE_MAX => 'This field must be shorter the {max}',

        ];
    }
    // general getter
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
    // general setter
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

    }
}