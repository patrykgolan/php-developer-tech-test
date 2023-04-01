<?php

namespace App\Controller;

use App\Models\Form;
use App\Service\CompanyMatcher;

class FormController extends Controller
{
    public function index()
    {
        $this->render('form.twig');
    }

    public function submit()
    {
        $request = $this->sanitize($_REQUEST);

        // get data - rest of the data is omitted as is not necessary at this stage
        $postcode = $request['postcode'];
        $bedrooms = $request['bedrooms'];
        $type = $request['type'];

        $form = new Form($postcode, $bedrooms, $type);
        if($form->validate()){
            $companies = new CompanyMatcher();
            $companies->match($form->__get('postcode'), $form->__get('bedrooms'), $form->__get('type'));
            $companies->pick();
            $matchedCompanies = $companies->results();
            $this->render('results.twig', [
                'matchedCompanies'  => $matchedCompanies,
            ]);
        }

    }

}