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
            [
                'column' => 'postcodes',
                'operator' => 'LIKE',
                'value' => '%"'.$prefix.'"%' // add "" as column is a array saved as string
            ],
            [
                'column' => 'bedrooms',
                'operator' => 'LIKE',
                'value' => '%"'.$bedrooms.'"%' // add "" as column is a array saved as string
            ],
            [
                'column' => 'type',
                'operator' => '=',
                'value' => $types
            ],
        ];

        // get matches
        $matches = (new CompanyMatchingSettings)->findAllWhere($where);

        // get company details for all matches
        foreach ($matches as $match){
            $id = $match['id'];
            // ad object as array for view
            $companyData = (new Company)->findWhereId($id);
            // only add active companies and with credit
            if($companyData->credits > 0 && $companyData->active){

                //add
                array_push($this->matches, $companyData);
            }
            // just an idea here to add elseif statement for companies with 0 credit
            // method sending an email to company telling them about missed opportunity and remind about topping up the credit
        }

    }

    public function pick($count = null): void
    {
        // get default count
        $count = $count ?? $_ENV['MAX_MATCHED_COMPANIES'];

        // get current matches count
        $currentCount = count($this->matches);

        // reduce matches if current count is higher the pick count
        if($currentCount > $count){
            // shuffle and reduce array
            shuffle($this->matches);
            $this->matches = array_slice($this->matches, 0, $count);
        }


    }

    public function matches()
    {
        $matches = [];
        // deduct credit if was shown in result

        /**
         * @param Company $match
         */
        foreach ($this->matches as $match){
            // add to view array
            $matches[] = [
                'credits' => $match->credits,
                'name' => $match->name,
                'description' => $match->description,
                'phone' => $match->phone,
                'email' => $match->email,
                'website' => $match->website,
            ];

            // deduct credits
            $match->deductCredits();
            // log if the credit was one (after deduction will be 0)
            if($match->credit === 1){

                $match->logZeroCredit();

            }
        }
        return $matches;
    }



}
