<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CoursController extends AbstractController
{
    #[Route('/routing', name: 'app_cours_routing')]
    public function routing(): Response
    {
        return $this->render('cours/routing.html.twig', [
          'title' => 'routing'
        ]);
    }

    #[Route('/routing-param', name: 'app_cours_routing_param')]
    public function routingParam(): Response
    {
        return $this->render('cours/routing-param.html.twig', [
          'title' => 'routing param'
        ]);
    }

    #[Route('/twig-variable', name: 'app_cours_twig_variable')]
    public function twigVariable(): Response
    {
        return $this->render('cours/twig-variable.html.twig', [
          'title' => 'twig variable',
          'prenom' => 'Mathieu',
          'formation' => 'CDA ALT',
          'notes' => [12, 15, 18],
          'user' => [
              'name' => 'Ada',
              'role' => 'developpeuse'
          ]
        ]);
    }
}
