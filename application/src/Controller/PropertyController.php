<?php

namespace App\Controller;

use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/property", name="property_")
 */
class PropertyController extends AbstractController
{

    /**
     * @return Response
     * @Route("search", name="search")
     */
    public function index(): Response
    {
        $rService = new ReservationService($this->container);

        $rService->searchProperty('2023-10-29','2022-11-02',null);

    }
}
