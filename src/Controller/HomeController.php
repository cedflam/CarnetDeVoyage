<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param ArticleRepository $repo
     * @return Response
     */
    public function index(ArticleRepository $repo)
    {
        return $this->render('home/index-blog.html.twig', [
            //Résultat trié par date descandante
            'articles' => $repo->findBy([], ['date' => 'DESC'])
        ]);
    }
}
