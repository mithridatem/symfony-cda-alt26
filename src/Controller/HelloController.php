<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController
{
    #[Route(path:'/hello', name:'app_hello_hello')]
    public function hello(): Response
    {
        return new Response("Hello World");
    }

    #[Route(path:'/bonjour/{name}', name:'app_hello_hello_user')]
    public function helloUser(string $name): Response 
    {
        return new Response("Bonjour " . $name);
    }

    #[Route(path:'/calcul/{operator}/{nbr1}/{nbr2}')]
    public function calcul(string $operator, mixed $nbr1, mixed $nbr2): Response 
    {
        $resultat = "";
        //Test si $nbr1 ou $nbr2 sont des nombres
        if (!is_numeric($nbr1) || !is_numeric($nbr2)) {
            $resultat = " Veuillez saisir des nombres";
        } else {
            switch($operator) {
                case 'add':
                    $resultat = " addition " . ($nbr1 + $nbr2);
                    break;
                case 'sous':
                    $resultat = " soustraction " . ($nbr1 - $nbr2);
                    break;
                case 'multi':
                    $resultat = " multiplication " . ($nbr1 * $nbr2);
                    break;
                case 'div':
                    if( $nbr2 == 0) {
                        $resultat = " division par zéro impossible";
                    } else {
                        $resultat = " division " . ($nbr1 / $nbr2);
                    }
                default:
                    $resultat = " Opération impossible";
            }
        }

        return new Response("Le résultat est : " . $resultat);
    }
}
