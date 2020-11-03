<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
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

    // GET DETAIL ARTICLE EN FONCTION DE L'ID
    public function detail(Request $request)
    {
        $id = $request->get('id');

        // SELECT * WHERE ID = ID CHOISI
        /** @var Article $article */
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticle($id);

        $commentaires = $this->getDoctrine()
            ->getRepository(Commentaire::class)
            ->getCommentByArticleId($id);
        dump($article);
        return $this->render('toutUtilisateur/detailArticleSelection.html.twig', [
            'article' => $article,
            'comments' => $commentaires
        ]);
    }
    public function comment(Request $request)
    {
        $id = $request->get('id');

        // SELECT * WHERE ID = ID CHOISI
        /** @var Article $article */
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticle($id);

        if(isset($_POST['comment'])){
            if(!empty($_POST['comment'])){
                $entityManager = $this->getDoctrine()->getManager();

                $commentaire = new Commentaire();
                $commentaire->setIdUser($this->getUser());
                $commentaire->setIdArticle($article[0]);
                $commentaire->setContenu($_POST['comment']);
                $entityManager->persist($commentaire);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('page_detaillée', ['id'=>$id]);
    }
}
