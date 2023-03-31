<?php

namespace App;

use app\core\Application;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';

    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public array $errors = [];

    abstract public function rules(): array;



    public function validate($mode = ''): bool
    {

        foreach ($this->rules() as $attribute => $rules){

            $value = $this->{$attribute};

            foreach ($rules as $rule){

                $ruleName = $rule;

                if (!is_string($ruleName)){

                    $ruleName = $rule[0];

                }
                // required rule
                if ($ruleName === self::RULE_REQUIRED && !$value){

                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);

                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){

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

        return empty($this->errors);
    }

    private function addErrorForRule(string $attribute, string $rule, $params = []): void
    {

        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value){

            $message = str_replace("{{$key}}", $value, $message);

        }

        $this->errors[$attribute][] = $message;

    }


    public function errorMessages(): array
    {

        return [

            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email',
            self::RULE_MIN => 'This field must be longer then {min}',
            self::RULE_MAX => 'This field must be shorter the {max}',
            self::RULE_MATCH => 'This field must match {match}',
            self::RULE_UNIQUE => 'Record with this {field} already exists in database'

        ];
    }


}