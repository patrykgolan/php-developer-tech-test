<?php

use App\Service\CompanyMatcher;
use App\Service\Form;
use PHPUnit\Framework\TestCase;

require __DIR__ . "/../app/Database/DatabaseConnection.php";

class FormTest extends TestCase
{
    public function testAdd(){

        $postcode = 'CF104DD';
        $bedrooms = 1;
        $type = 'building';

        $form = new Form($postcode, $bedrooms, $type);
        $this->assertTrue($form->validate());

        $companies = new CompanyMatcher();
        $this->assertEquals($postcode, $form->__get('postcode'));
        $this->assertEquals($bedrooms, $form->__get('bedrooms'));
        $this->assertEquals($type, $form->__get('type'));


    }

}