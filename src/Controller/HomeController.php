<?php

namespace App\Controller;

use App\Entity\Travel;
use App\Form\TravelType;
use App\Services\StationsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET","POST"})
     * @param Request $request
     * @param StationsService $stationsService
     * @return Response
     */
    public function index(Request $request, StationsService $stationsService): Response
    {

        $stations = $stationsService->getStations();
        $travel = new Travel();
        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $travel->setDistance($_POST['distance']);
            $travel->setDuration($_POST['time']);
            $entityManager->persist($travel);
            $entityManager->flush();
            var_dump($travel);
            //return $this->redirectToRoute('home_index');
        }

        return $this->render('/home/index.html.twig', [
            'stations' => $stations,
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }

}
