<?php

namespace App\Service;

use App\Models\CompanyMatchingSettings;

class CompanyMatcher
{
    private array $matches = [];


    public function match(string $postcode, int $bedrooms, string $types) : void
    {
        //prepare postcodes
        $firstLetterOfPrefix = substr($postcode, 0, 1);
        $prefix = substr($postcode, 0, 2);

        $where = [
            [
                'column' => 'postcodes',
                'operator' => 'LIKE',
                'value' => '%'.$firstLetterOfPrefix.'%'
            ],
            [
                'column' => 'postcodes',
                'operator' => 'LIKE',
                'value' => '%'.$prefix.'%'
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
            var_dump();
        }


        return $this->matches;
    }


    public function deductCredits()
    {
        
    }

}
