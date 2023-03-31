<?php

namespace App\Controller;

use App\Database\DatabaseConnection;

abstract class Controller
{

    /**
     * Renders a twig template with the params provided.
     *
     * @param string $view
     * @param array $params
     */
    protected function render(string $view, array $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../resources/views');
        $twig = new \Twig\Environment($loader);

        echo $twig->render(sprintf('layouts/%s', $view), $params);
    }

    protected static function sanitize($input): array|string
    {
        // if the input is array loop through all elements
        if(is_array($input)){

            foreach($input as $key => $value){

                $result[$key] = self::sanitize($value);

            }

        } else {
            // samitize usign htmlentities
            $result = htmlentities(trim($input), ENT_QUOTES, 'UTF-8');
        }


        return $result;
    }


}