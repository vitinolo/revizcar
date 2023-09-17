<?php

namespace App\Controller;
use App\Repository\CarRepository; //appel repository
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/', name: 'app_car')]
    public function index(CarRepository $repo): Response 
    {
        $car = $repo->findBy([], ['createdAt' => 'DESC'], 10);
        return $this->render('car/car.html.twig', [
            'car' => $car
        ]);
    }
}
