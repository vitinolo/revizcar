<?php

namespace App\Controller;
use App\Repository\CarRepository; //appel repository
use App\Repository\RevisionRepository; //appel repository
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{   //affichage des cars
    #[Route('/', name: 'app_car')]
    public function index(CarRepository $repo): Response 
    {
        $car = $repo->findBy([], ['createdAt' => 'DESC'], 10);
        return $this->render('car/car.html.twig', [
            'car' => $car
        ]);
    }

    //affichage d'un car
    #[Route('/{id}', name: 'showone', requirements:['id'=>'\d+'])]
    public function showOne($id, CarRepository $repo, EntityManagerInterface $em ){
      //1. récupèrer la librairie à afficher en utilisant l'id
      $car = $repo->find($id);
      //2. vérifier si le livre existe
      if(!$car){
        throw $this->createNotFoundException('le livre demandé n\existe pas');
      } 
      //3. on retourne la vue portant détail du livre
      return $this->render('shows/show.html.twig',[
        'car'=> $car,
      ]);
    }
}
