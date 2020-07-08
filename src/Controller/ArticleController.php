<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Image;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        /**
         * Pour créer un upload multiple il faut une entité Image(pour ensuite lier l'image à l'article) et une entité Article
         * 1) Modifier le formulaire Article pour ajouter le champs d'upload multiple (voir ArticleType.php)
         * 2) Modifier le fichier config/services.yaml (voir le fichier ligne "parameters")
         * 3) Penser à mettre "cascade={"persist"}" dans la classe Article $images pour la persistance des images
         */
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Je récupère les images transmises
            $images = $form->get('images')->getData();
            //Je boucle sur les images
            foreach($images as $image){
                //Je génère un nouveau nom de fichier
                $file = md5(uniqid()) . '.' .$image->guessExtension();
                //Je copie le fichier dans le dossier upload
                $image->move(
                    $this->getParameter('images_directory'),
                    $file
                );
                //Je stocke le nom de l'image dans la bdd
                //Je crée une nouvelle instance d'Image
                $img = new Image();
                //Je paramètre le nom
                $img->setImage($file);
                //Je lie l'image à l'article
                $article->addImage($img);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     * @param Article $article
     * @return Response
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Je récupère les images transmises
            $images = $form->get('images')->getData();
            //Je boucle sur les images
            foreach($images as $image){
                //Je génère un nouveau nom de fichier
                $file = md5(uniqid()) . '.' .$image->guessExtension();
                //Je copie le fichier dans le dossier upload
                $image->move(
                    $this->getParameter('images_directory'),
                    $file
                );
                //Je stocke le nom de l'image dans la bdd
                //Je crée une nouvelle instance d'Image
                $img = new Image();
                //Je paramètre le nom
                $img->setImage($file);
                //Je lie l'image à l'article
                $article->addImage($img);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }

    /**
     * Permet de supprimer des images
     * @Route("/delete/image/{id}", name="image_delete", methods={"DELETE"})
     * @param Image $image
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return JsonResponse
     */
    public function deleteImage(Image $image, Request $request, EntityManagerInterface $manager)
    {
        $data = json_decode($request->getContent(), true);
        //Je vérifie si le token est valide
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            //Je récupère le nom de l'image
            $nom = $image->getImage();
            //Je supprime l'image de la bdd
            unlink($this->getParameter('images_directory'). '.' .$nom);
            $manager->remove($image);
            $manager->flush();
            //Réponse json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token invalid'], 400);
        }
    }
}
