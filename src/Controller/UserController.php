<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    private $repository;
    private $session;
    private $em;

    public function __construct(SessionInterface $session, UserRepository $repository, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index()
    {
        $users = $this->repository->findAll();
        return $this->render($view = 'user/index.html.twig', compact('users'));
    }

    public function create(Request $resquest): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            //$this->addFlash('success', 'Votre profil a été créer avec succès');
            return $this->redirectToRoute('index');
        }

        return $this->render($view = 'user/create.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            //$this->addFlash('success', 'Modifier avec succès');
            return $this->redirectToRoute('index');
        }

        return $this->render($view = 'user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    public function adminEdit(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            //$this->addFlash('success', 'Modifier avec succès');
            return $this->redirectToRoute('liste_utilisateur');
        }

        return $this->render($view = 'user/adminEdit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    public function delete(User $user, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))) {
            $this->em->remove($user);
            $this->em->flush();
            //$this->addFlash('success', 'Supprimer avec succès');
        }
        return $this->redirectToRoute('liste_utilisateur');
    }
}
