<?php

namespace App\Controller;

use App\Service\ReservationService;
use App\Service\ResponseService\Constants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/property", name="property_")
 */
class PropertyController extends CoreController
{

    /**
     * @return Response
     * @Route("/search", name="search")
     */
    public function search(): Response
    {
        $dateIn = $this->getRequest()->query->get('dateIn') ? new \DateTime($this->getRequest()->query->get('dateIn')) : new \DateTime('now');
        $dateOut = $this->getRequest()->query->get('dateOut') ? new \DateTime($this->getRequest()->query->get('dateOut')) : (new \DateTime('now'))->modify('+2 days');

        $rService = new ReservationService($this->container);
        $properties = $rService->searchProperty($dateIn,$dateOut,null);
        return $this->getResponseService()->toJsonResponse($properties->getResponse(), Constants::MSG_200_0000, $properties->getMessage());
    }

    /**
     * @return Response
     * @Route("", name="list");
     */
    public function list(): Response
    {
        $rService = new ReservationService($this->container);
        $properties = $rService->listProperty();
        return $this->getResponseService()->toJsonResponse($properties->getResponse(), Constants::MSG_200_0000, $properties->getMessage());
    }

    /**
     * @return Response
     * @Route("/detail/{id}", name="detail");
     */
    public function detail($id): Response
    {
        $rService = new ReservationService($this->container);
        $properties = $rService->detailProperty($id);
        return $this->getResponseService()->toJsonResponse($properties->getResponse(), Constants::MSG_200_0000, $properties->getMessage());
    }
}
