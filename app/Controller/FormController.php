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
        // sanitize post request
        $request = $this->sanitize($_REQUEST);

        // get data - rest of the data is omitted as is not necessary at this stage
        $postcode = $request['postcode'];
        $bedrooms = $request['bedrooms'];
        $type = $request['type'];

        // create form object
        $form = new Form($postcode, $bedrooms, $type);

        // validate form
        if($form->validate()){

            // match companies
            $companies = new CompanyMatcher();
            $companies->match($form->__get('postcode'), $form->__get('bedrooms'), $form->__get('type'));

            // pick
            $companies->pick();

            // create local var
            $matchedCompanies = $companies->matches();

            // render view
            // for future reference would be good to show some error alerts if data won't pass backend validation
            $this->render('results.twig', [
                'matchedCompanies'  => $matchedCompanies,
            ]);


        }

    }

}