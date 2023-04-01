<?php

namespace App\Service;

use App\Models\CompanyMatchingSettings;

class CompanyMatcher
{
    private array $matches = [];


    public function match(string $postcode, int $bedrooms, string $types) : void
    {
        $where = [
            [
                'column' => 'postcode',
                'operator' => 'LIKE',
                'value' => '%'.$postcode.'%'
            ],
            [
                'column' => 'bedrooms',
                'operator' => 'LIKE',
                'value' => '%'.$bedrooms.'%'
            ],
            [
                'column' => 'types',
                'operator' => '=',
                'value' => $types
            ],
        ];

        $this->matches =  CompanyMatchingSettings::findAllWhere($where);
    }

    public function pick($count = null): void
    {
        // get default count
        $count = $count ?? $_ENV['MAX_MATCHED_COMPANIES'];

        // get current matches count
        $currentCount = $count($this->matches);

        // reduce matches if current count is higher the pick count
        if($currentCount > $count){

            // get random elements
            $this->matches = array_rand($this->matches, $count);

        }

    }


    public function deductCredits()
    {
        
    }

}
