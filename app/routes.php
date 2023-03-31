<?php

return [
    '/form' => [
        [
            'type'      => 'GET',
            'handler'   => 'FormController@index',   
        ],       
    ],
    '/form' => [
        [
            'type'      => 'POST',
            'handler'   => 'FormController@submit',
        ],
    ],

];