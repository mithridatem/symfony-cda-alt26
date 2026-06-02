<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TwigController extends AbstractController
{
    #[Route('/twig/{name}', name: 'app_twig')]
    public function index(string $name): Response
    {
        return $this->render('twig/index.html.twig', [
           'title' => 'twig page',
           'prenom' => $name
        ]);
    }


    #[Route('/calculatrice/{operator}/{nbr1}/{nbr2}', name: 'app_twig_calculatrice')]
    public function calculatrice(string $operator, mixed $nbr1, mixed $nbr2): Response
    {

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
                    break;
                default:
                    $resultat = " Opération impossible";
                    break;
            }
        }
        return $this->render('twig/calc.html.twig', [
           'title' => 'calculatrice',
           'resultat' => $resultat ?? "",
        ]);
    }

    #[Route('/calctwig/{operator}/{nbr1}/{nbr2}', name: 'app_twig_calc_twig')]
    public function calculatriceTwig(string $operator, mixed $nbr1, mixed $nbr2): Response
    {

        return $this->render('twig/calc_twig.html.twig', [
           'title' => 'calculatrice',
           'operator' => $operator,
           'nbr1' => $nbr1,
           'nbr2' => $nbr2
        ]);
    }
}
