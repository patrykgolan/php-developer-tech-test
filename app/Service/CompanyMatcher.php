<?php

namespace App\Service;

use App\Models\Company;
use App\Models\CompanyMatchingSettings;

class CompanyMatcher
{
    private array $matches = [];


    public function match(string $postcode, int $bedrooms, string $types) : void
    {
        //prepare postcodes

        $prefix = substr($postcode, 0, 2);

        $where = [
            // only companies with credits
            [
                'column' => 'credits',
                'operator' => '>',
                'value' => 0,
            ],
            [
                'column' => 'postcodes',
                'operator' => 'LIKE',
                'value' => '%"'.$prefix.'"%' // add "" as column is a array saved as string
            ],
            [
                'column' => 'bedrooms',
                'operator' => 'LIKE',
                'value' => '%'.$bedrooms.'%'
            ],
            [
                'column' => 'type',
                'operator' => '=',
                'value' => $types
            ],
        ];

        $matches = (new CompanyMatchingSettings)->findAllWhere($where);

        // get ids and set them as matches value
        $this->matches = array_combine(array_column($matches, 'id'), $matches);
    }

    public function pick($count = null): void
    {
        // get default count
        $count = $count ?? $_ENV['MAX_MATCHED_COMPANIES'];

        // get current matches count
        $currentCount = count($this->matches);

        // reduce matches if current count is higher the pick count
        if($currentCount > $count){

            // get random elements
            $this->matches = array_rand($this->matches, $count);

        }

    }

    public function matches()
    {
        $matches = [];

        foreach ($this->matches as $match){

            // ad object as array for view
            $companyData = (new Company)->findWhereId($match);
            $matches[] = [
                'name' => $companyData->name,
                'description' => $companyData->description,
                'phone' => $companyData->phone,
                'email' => $companyData->email,
                'website' => $companyData->website,
            ];

            $match->deduct('credits');
        }
        return $matches;
    }



}
