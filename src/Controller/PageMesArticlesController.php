<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageMesArticlesController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    // AFFICHER TOUT MES ARTICLES
    public function mesArticles()
    {
        $session_test = 1;

        /** @var Article $mes_articles */
        $mes_articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticleByUserId($session_test);


        return $this->render('article/voirArticles.html.twig', [
            'mes_articles' => $mes_articles,
        ]);
    }

    // SUPPRIMER MON ARTICLE EN QUESTION
    public function supprimerArticle(Request $request, Article $article)
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token'))) {

            $entityManager->remove($article);
            $entityManager->flush();
            $this->addFlash('success', "L'article " . $article->getTitre() . ' à bien été supprimée.');
        }



        return $this->redirectToRoute('mes_articles');
    }
}
