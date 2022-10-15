<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Property;
use App\Repository\AddressRepository;
use App\Repository\PropertyRepository;
use App\ViewObjects\ReservationObject;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReservationService
{

    private ContainerInterface $container;
    private PropertyRepository $propertyRepository;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine')->getManager();
        $this->propertyRepository = $em->getRepository(Property::class);
    }

    public function searchProperty($dateIn, $dateOut, $otherFilter)
    {
        $properties = $this->propertyRepository->findReservation($dateIn, $dateOut);

        if ($properties->isSuccess()) {
            if (count($properties->getResponse()) < 1) {
                throw new NotFoundHttpException();
            }

            $propertyArray = [];
            foreach ($properties->getResponse() as $property) {
                $propertyArray[] = ReservationObject::create(['property' => $property, 'dateIn' => $dateIn, 'dateOut' => $dateOut])->toSimpleArray();
            }
        }

        return new ServiceResponse($propertyArray);

    }

    public function listProperty()
    {
        $properties = $this->propertyRepository->findAllWithByResponse();

        if ($properties->isSuccess()) {
            if (count($properties->getResponse()) < 1) {
                throw new NotFoundHttpException();
            }

            $propertyArray = [];
            foreach ($properties->getResponse() as $property) {
                $propertyArray[] = ReservationObject::create(['property' => $property, 'dateIn' => null, 'dateOut' => null])->toSimpleArray();
            }
        }

        return new ServiceResponse($propertyArray);
    }

    public function detailProperty($propertyId)
    {
        $property = $this->propertyRepository->findWithResponse($propertyId);
        if ($property->isSuccess()) {
            if (!$property->getResponse() instanceof Property) {
                throw new NotFoundHttpException();
            }

            $property = ReservationObject::create(['property' => $property->getResponse(), 'dateIn' => null, 'dateOut' => null])->toArray();
        }

        return new ServiceResponse($property);
    }


}
