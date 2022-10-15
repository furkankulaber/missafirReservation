<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function findReservation($dateIn, $dateOut)
    {
        $subQueryBuilder = $this->getEntityManager()->createQueryBuilder();
        $subQuery = $subQueryBuilder
            ->select('pr.id')
            ->from(Reservation::class, 'r')
            ->orWhere('r.dateIn BETWEEN :checkInDate AND :checkOutDate')
            ->orWhere('r.dateOut BETWEEN :checkInDate AND :checkOutDate')
            ->orWhere('r.dateIn < :checkInDate AND r.dateOut > :checkOutDate')
            ->innerJoin('r.property', 'pr');

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb
            ->select('p')->from(Property::class, 'p')
            ->andWhere($qb->expr()->notIn('p.id', $subQuery->getDQL()))
            ->setParameter('checkInDate', $dateIn)
            ->setParameter('checkOutDate', $dateOut);

        return new RepositoryResponse($qb->getQuery()->getResult());
    }
}
