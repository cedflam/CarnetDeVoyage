<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     * @param Article $article
     * @return Response
     */
    public function index(Article $article)
    {
        return $this->render('article/article.html.twig', [
            "article" => $article
        ]);
    }
}
