<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\CalorieService;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PointsController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user")
     * @param User $user
     * @param CalorieService $calorieService
     *
     */
    public function calcPoints()

    {
        return $this->render('/user/index.html.twig');
    }
}
