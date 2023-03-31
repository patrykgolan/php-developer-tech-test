<?php

namespace App\Controller;

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
        $matcher = new CompanyMatcher();
        $matcher->match();
        $matchedCompanies = $matcher->results();
        $matcher->
        $this->render('results.twig', [
            'matchedCompanies'  => $matchedCompanies,
        ]);
    }

}