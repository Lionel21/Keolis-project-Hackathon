<?php

namespace App\Controller;

use App\Entity\Travel;
use App\Entity\User;
use App\Service\CalorieService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PointsController extends AbstractController
{
    /**
     * @Route("/travel/{user}", name="travel")
     *
     * @param Travel $travel
     * @param CalorieService $calorieService
     * @return Response
     */
    public function calcPoints(Travel $travel, CalorieService $calorieService):Response
    {
        $calory = $calorieService->calculCalories($travel->getUser()->getWeight());
        $travel->setCalory($calory);
        $user = $travel->getUser();
        return  $this->render('travel/show.html.twig',[
            'travel'=>$travel,
            'user'=>$user,
        ]);
    }
}
