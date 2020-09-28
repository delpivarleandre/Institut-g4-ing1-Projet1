<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageDetailController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session, ArticleRepository $repository)
    {
        $this->session = $session;
        $this->repository = $repository;
    }

    public function user()
    {
    }

    public function detail()
    {
        $id = $_GET['id'];

        /** @var Artcile $article */
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticle($id);

        // $user = $article[0]["id_user_id"];

        return $this->render('pages/pageDetail.html.twig', [
            'article' => $article,
            // 'user' => $user
        ]);
        //  [
        //     '$id' => $id,
        //     '$titre' => $titre,
        //     '$contenu' => $contenu,
        //     '$date_crea' => $date_crea,
        //     '$date_modif' => $date_modif,
        //     '$id_user' => $id_user,
        //     '$tagArticles' => $tagArticles,
        //     '$commentaires' => $commentaires
        // ]);
    }
}
