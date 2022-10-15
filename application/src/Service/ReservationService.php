<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Property;
use App\Entity\User;
use App\Repository\AddressRepository;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ReservationService
{

    private ContainerInterface $container;
    private PropertyRepository $propertyRepository;

    public function __construct(ContainerInterface $container, $encoder = null)
    {
        $this->container = $container;
        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine')->getManager();
        $this->propertyRepository = $em->getRepository(Property::class);
    }

    public function searchProperty($dateIn, $dateOut, $otherFilter)
    {
        $this->propertyRepository->findReservation($dateIn, $dateOut);
    }


}
