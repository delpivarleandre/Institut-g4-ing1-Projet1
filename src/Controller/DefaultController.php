<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Article;
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
        $params = [];
        //TODO connection backend
        $params['connected'] = false;
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
            $params['article'] = $article;
            $params['previousSearch'] = $_GET['search'];
        }else{
            /** @var Article $article */
            $article = $this->getDoctrine()
                ->getRepository(Article::class)
                ->findAll();
            $params['article'] = $article;
        }
        return $this->render('toutUtilisateur/accueil.html.twig', $params);
    }
}
