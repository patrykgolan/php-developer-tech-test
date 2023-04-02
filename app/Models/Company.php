<?php

namespace App\Models;

class Company extends \App\DbModel
{
    protected int $id;
    protected  int $active;
    protected string $name;
    protected int $credits;
    protected  string $description;
    protected string $email;
    protected string $phone;
    protected string $website;
    public static function tableName(): string
    {
        return 'companies';
    }

    public static function attributes(): array
    {
        return ['id', 'active', 'name', 'credits', 'description', 'email', 'phone', 'website'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }

    public function deductCredits()
    {
        $this->deduct('credits');
    }

    public function logZeroCredit()
    {
        Log::credits('Company '.$this->name.' ran out off credits');
    }
}