<?php

namespace App\Models;

class CompanyMatchingSettings extends DbModel
{
    protected int $company_id;
    protected array $postcodes;
    protected array $bedrooms;
    protected array $type;
    public static function tableName(): string
    {
        return 'company_matching_settings';
    }

    public static function attributes(): array
    {
        return ['company_id', 'postcodes', 'bedrooms', 'type'];
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