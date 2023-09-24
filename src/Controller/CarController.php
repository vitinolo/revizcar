<?php

namespace App\Controller;
use App\Repository\CarRepository; //appel repository
use App\Repository\RevisionRepository; //appel repository
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{   //affichage des cars

    #[Route('/', name: 'app_home')]
    public function home(): Response 
    {
        return $this->render('car/homeCar.html.twig', [
        ]);
    }
    #[Route('/car', name: 'app_car')]
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

    //route et affichage des révisions d'une voiture
    #[Route('/revisions{id}', name: 'revisions', requirements: ['id'=> '\d+'])]

    public function revisions($id, CarRepository $repo): Response 
    {   
        // Récupérer la voiture par son ID
        $car = $repo->find($id);

        // Vérifier si la voiture existe
        if (!$car) {
            throw $this->createNotFoundException('La voiture demandée n\'existe pas.');
        }
        
        // Récupérer les révisions associées à cette voiture, triées par ordre décroissant de datereviz
        $revisions = $car->getRevisions()->toArray();

        usort($revisions, function($a, $b) {
            return $b->getDatereviz() <= $a->getDatereviz();
        });

        return $this->render('revision/revision.html.twig', [
            'revision' => $revisions,
        ]);
    }

    //route et affichage des réparations d'une voiture
    #[Route('/reparations{id}', name: 'reparations', requirements: ['id'=> '\d+'])]

    public function reparations($id, CarRepository $repo2): Response 
    {   
        // Récupérer la voiture par son ID
        $car = $repo2->find($id);

        // Vérifier si la voiture existe
        if (!$car) {
            throw $this->createNotFoundException('La voiture demandée n\'existe pas.');
        }
        
        // Récupérer les révisions associées à cette voiture, triées par ordre décroissant de datereviz
        $reparations = $car->getReparations()->toArray();

        usort($reparations, function($c, $d) {
            return $d->getDaterep() <= $c->getDaterep();
        });

        return $this->render('reparation/reparation.html.twig', [
            'reparation' => $reparations,
        ]);
    }
    // Route pour la recherche d'une voiture par son immat
    #[Route('/search/car', name: 'search_car')]
    public function searchCar(Request $request, CarRepository $carRepository): Response
    {
        $carImmat = $request->query->get('car_immat');

        // Utilisez le Repository pour rechercher des bibliothèques par nom
        $car = $carRepository->findByImmat($carImmat);
        
        return $this->render('shows/showOne.html.twig', [
            'car' => $car,
            'search_query' => $carImmat,
        ]);
    }
    
}
