<?php

namespace App\Models;

class Company extends DbModel
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
        // no rules were apliad for this project so far, but in case of further development following rules should be applied
        // email,
        // uk phone number
        // description (max 256)
        // active - bool
        // website - valid url
        // name - just letters, max 256
        // credits - int, 0 or more
        return [];
    }

    public function deductCredits()
    {
        // -1
        $this->deduct('credits');
    }

    public function logZeroCredit()
    {
        // add to logs/credits.log
        Log::credits('Company '.$this->name.' ran out off credits');
    }
}