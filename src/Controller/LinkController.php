<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LinkController extends AbstractController
{
    public function __construct(
        private readonly LinkRepository $linkRepository
    ) {}

    #[Route('/links', name: 'app_link_show_all_link')]
    public function showAllLink(): Response
    {
        $links = $this->linkRepository->findAll();

        return $this->render('link/show_all_link.html.twig', [
            'title' => 'Liste des Links',
            'links' => $links ?? []
        ]);
    }

    #[Route('/link/{id}', name: 'app_link_show_link')]
    public function showLink(int $id): Response
    {
        $link = $this->linkRepository->find($id);

        return $this->render('link/show_link_id.html.twig', [
            'title' => 'Link',
            'link' => $link
        ]);
    }

    
}
