<?php

namespace App\Controller;
use App\Repository\RevisionRepository; //appel repository
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RevisionController extends AbstractController
{
    #[Route('/revision', name: 'app_revision')]
    public function index(RevisionRepository $repo): Response 
    {
        $revision = $repo->findBy([], ['datereviz' => 'DESC'], 10);
        return $this->render('revision/revision.html.twig', [
            'revision' => $revision
        ]);
    }
/**
 * @Route("/redirection", name="redirection_route")
 */
public function redirectionAction()
{
    return new RedirectResponse($this->generateUrl('app_revision'));
}
}

