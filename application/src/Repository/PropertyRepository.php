<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function findReservation($dateIn, $dateOut)
    {
        $subQueryBuilder = $this->getEntityManager()->createQueryBuilder();
        $subQuery = $subQueryBuilder
            ->select('id')
            ->from(Reservation::class, 'r')
            ->orWhere('r.dateIn BETWEEN :checkInDate AND :checkOutDate')
            ->orWhere('r.dateOut BETWEEN :checkInDate AND :checkOutDate')
            ->orWhere('r.dateIn <= :checkInDate AND reservation.dateOut >= :checkOutDate')
            ->setParameter('checkInDate',$dateIn)
            ->setParameter('checkOutDate', $dateOut);

        dump($subQuery->getQuery()->getResult());
    }
}
