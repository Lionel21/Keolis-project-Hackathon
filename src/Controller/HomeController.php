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
            $data = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $travel->setDistance($_POST['distance']);
            $travel->setDuration($_POST['time']);
            $travel->setUser($this->getUser());
            $entityManager->persist($travel);
            $entityManager->flush();

            return $this->redirectToRoute('home_road', [
                'start' => $_POST['travel']['start'],
                'finish' => $_POST['travel']['finish'],
            ]);
        }

        return $this->render('/home/index.html.twig', [
            'stations' => $stations,
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/road/", name="home_road", methods={"GET","POST"})
     * @param Request $request
     * @param StationsService $stationsService
     * @return Response
     */
    public function road(Request $request, StationsService $stationsService): Response
    {
        return $this->render('/home/road.html.twig', [
            'stations' => [$_GET['start'], $_GET['finish']],
        ]);
    }
}
