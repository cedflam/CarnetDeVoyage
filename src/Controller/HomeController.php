<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @IsGranted("ROLE_USER")
     * @param ArticleRepository $repo
     * @return Response
     */
    public function index(ArticleRepository $repo)
    {

        return $this->render('home/index-blog.html.twig', [
            //Résultat trié par date descandante
            'articles' => $repo->findBy([], ['date' => 'DESC']),

        ]);
    }
}
