<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\TagArticle;
use App\Entity\Tag;
use App\Form\ArticleType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;


class PageMesArticlesController extends AbstractController
{
    private $session;
    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    // AFFICHER TOUT MES ARTICLES
    public function mesArticles()
    {
        $session_test = 1;

        // SELECT * WHERE ID USER = ID USER CONNECTÉ        
        /** @var Article $mes_articles */
        $mes_articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticleByUserId($session_test); //


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
        return $this->render('article/voirArticles.html.twig');
    }

    // CREER UN ARTICLE 
    public function ajouterArticle(Request $resquest): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setIdUser($this->getUser());
            $article->setDateCrea(new DateTime());
            $article->setDateModif(new DateTime());
            $this->em->persist($article);
            $this->em->flush();
            $this->addFlash('success', 'Votre profil a été créer avec succès');
            return $this->redirectToRoute('article/voirArticles.html.twig');
        }

        return $this->render('article/creeArticle.html.twig', [
            'article' => $article,
            'les_tags' => $this->lesTags(),
            'form' => $form->createView()
        ]);
    }

    //EDIT L'ARTICLE CHOISI
    public function modifierArticle(Article $article, Request $request)
    {
        $array_tab = $request->get('id');
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        // SELECT * WHERE ID USER = ID USER CONNECTÉ        
        /** @var TagArticle $tag_article */
        $tag_article = $this->getDoctrine()
            ->getRepository(TagArticle::class)
            ->findTagByArticle($array_tab);


        if ($form->isSubmitted() && $form->isValid()) {
            $article->setDateModif(new DateTime());
            $this->em->flush();
            //$this->addFlash('success', 'Modifier avec succès');
            return $this->redirectToRoute('mes_articles');
        }

        return $this->render('article/modifierArticle.html.twig', [
            'tag_article' => $tag_article,
            'article' => $article,
            'les_tags' => $this->lesTags(),
            'form' => $form->createView()
        ]);
    }


    public function lesTags()
    {
        // SELECT * TAG
        /** @var Tag $les_tags */
        $les_tags = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findAll();

        return $les_tags;
    }
}
