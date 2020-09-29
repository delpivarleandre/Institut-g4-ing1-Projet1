<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    // private $twig;

    // public function __construct(Environment $twig)
    // {
    //     $this->twig = $twig;
    // }

    public function index()
    {
        if(isset($_GET['search'])){
            if(isset($_GET['expandSearch'])){
                /** @var Article $article */
                $article = $this->getDoctrine()
                    ->getRepository(Article::class)
                    ->searchArticleExpanded($_GET['search']);
            } else {
                /** @var Article $article */
                $article = $this->getDoctrine()
                    ->getRepository(Article::class)
                    ->searchArticle($_GET['search']);
            }
            return $this->render('pages/pageAccueil.html.twig', [
                'article' => $article,
                'previousSearch' => $_GET['search']
            ]);
        }else{
            /** @var Article $article */
            $article = $this->getDoctrine()
                ->getRepository(Article::class)
                ->findAll();
            return $this->render('pages/pageAccueil.html.twig', [
                'article' => $article,
                'previousSearch' => ''
            ]);
        }

    }
}
