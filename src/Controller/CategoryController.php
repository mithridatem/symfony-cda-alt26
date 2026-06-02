<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Repository\LinkRepository;

final class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private LinkRepository $linkRepository
    ) {}


    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {

        $categories = $this->categoryRepository->findAll();
        $link = $this->linkRepository->find(679);

        return $this->render('category/index.html.twig', [
           'categories' => $categories,
           'link' => $link
        ]);
    }
}
