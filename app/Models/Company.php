<?php

namespace App\Models;

class Company extends \App\DbModel
{
    private int $id;
    private  int $active;
    private string $name;
    private int $credits;
    private  int $description;
    private int $email;
    private int $phone;
    private int $website;
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
}