<?php

namespace App\Controller;

use App\Entity\travel;
use App\Entity\User;
use App\Service\CalorieService;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PointsController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user")
     * @param travel $travel
     * @param CalorieService $calorieService
     * @return Response
     */
    public function calcPoints(travel $travel, CalorieService $calorieService):Response
    {
        $calory = $calorieService->calculCalories($travel->getUser()->$travel->getDuration());
        return  $this->render('user/index.html.twig',[
            'travel'=> $travel
        ]);
    }
}
