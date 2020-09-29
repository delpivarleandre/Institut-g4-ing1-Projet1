<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageMesArticlesController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function user()
    {
    }

    public function mesArticles()
    {
        $id = $_GET['id'];

        /** @var Artcile $article */
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticle($id);


        return $this->render('pages/pageDetail.html.twig', [
            'article' => $article,
        ]);
    }
}
