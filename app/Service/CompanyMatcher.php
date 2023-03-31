<?php

namespace App\Service;

use App\DbModel;

class CompanyMatcher extends DbModel
{

    private array $matches = [];

    public function match()
    {
        
    }

    public function pick(int $count)
    {
        
    }

    public function results(): array
    {
        return $this->matches;
    }

    public function deductCredits()
    {
        
    }

    public static function tableName(): string
    {
        // TODO: Implement tableName() method.
    }

    public static function attributes(): array
    {
        // TODO: Implement attributes() method.
    }

    public static function primaryKey(): string
    {
        // TODO: Implement primaryKey() method.
    }
}
