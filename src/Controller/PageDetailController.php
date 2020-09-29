<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;


class PageDetailController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    public function detail(Request $request)
    {
        $id = $request->get('id');

        /** @var Article $article */
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticle($id);


        return $this->render('pages/pageDetail.html.twig', [
            'article' => $article,
            'previousSearch' => ''
        ]);
    }
}
