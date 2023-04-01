<?php

namespace App\Models;

class Company extends \App\DbModel
{
    private int $id;
    private  int $active;
    protected string $name;
    private int $credits;
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

    }
}