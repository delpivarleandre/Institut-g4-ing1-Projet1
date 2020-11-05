<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\TagArticle;
use App\Entity\Tag;
use App\Form\ArticleType;
use App\Repository\TagArticleRepository;
use App\Repository\TagRepository;
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
        $id = $this->getUser()->getId();

        // SELECT * WHERE ID USER = ID USER CONNECTÉ        
        /** @var Article $mes_articles */
        $mes_articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticleByUserId($id); //


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

    // CREER UN ARTICLE 
    public function ajouterArticle(Request $request,TagRepository $tr): Response
    {
        $article = new Article();
        $tag_article = new TagArticle();
        $array_post_article_tag = $_POST;

        if ($array_post_article_tag) {
            $article->setTitre($array_post_article_tag["titre"]);
            $article->setContenu($array_post_article_tag["contenu"]);
            $article->setIdUser($this->getUser());
            $article->setDateCrea(new DateTime());
            $article->setDateModif(new DateTime());
            $this->em->persist($article);
            $this->em->flush();
            foreach ($array_post_article_tag["tag"] as $id => $value) {
                $tag_article->setIdArticle($article);
                $tag_article->setIdTag($tr->findOneBy(['id' => $id]));
                $this->em->persist($tag_article);
                $this->em->flush();
            }
            $this->addFlash('success', 'Votre article a été créer avec succès');
            return $this->redirectToRoute('mes_articles');
        } else {
            return $this->render('article/creeArticle.html.twig', [
                'article' => $article,
                'les_tags' => $this->lesTags(),
            ]);
        }
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
    //EDIT L'ARTICLE CHOISI
    public function modifierArticle(Article $article, Request $request, TagRepository $tr, TagArticleRepository $tar)
    {

        $array_post_article_tag = $_POST;
        if ($array_post_article_tag) {

            $article->setTitre($array_post_article_tag["titre"]);
            $article->setContenu($array_post_article_tag["contenu"]);
            $article->setDateModif(new DateTime());
            $this->em->persist($article);
            $this->em->flush();
            $tar->deleteAllbyArticle($article->getid());

            foreach ($array_post_article_tag["tag"] as $id => $value) {
                $tag_article = new TagArticle;
                $tag_article->setIdArticle($article);
                $tag_article->setIdTag($tr->findOneBy(['id' => $id]));
                var_dump($tr->findOneBy(['id' => $id]));
                $this->em->persist($tag_article);
                $this->em->flush();
            }


            $this->addFlash('success', 'Votre article a été modifié avec succès');
            return $this->redirectToRoute('mes_articles');
        }

        $checked = [];
        foreach ($article->getTagArticles() as $tag_article) {
            $checked[] = $tag_article->getIdTag();
        }
        return $this->render('article/modifierArticle.html.twig', [
            'article' => $article,
            'checked' => $checked,
            'les_tags' => $this->lesTags(),
        ]);
    }
}
