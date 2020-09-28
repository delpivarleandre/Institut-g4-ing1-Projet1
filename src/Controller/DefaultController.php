<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DefaultController extends AbstractController
{

    // private $twig;

    // public function __construct(Environment $twig)
    // {
    //     $this->twig = $twig;
    // }

    public function index()
    {
        /** @var Artcile $article */
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        return $this->render('pages/pageAccueil.html.twig', [
            'article' => $article
        ]);
    }
}
