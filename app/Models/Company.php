<?php

namespace App\Models;

class Company extends \App\DbModel
{
    private int $id;
    private  int $active;
    private string $name;
    private int $credits;
    private  string $description;
    private string $email;
    private string $phone;
    private string $website;
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