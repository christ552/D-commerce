<?php

namespace App\Repository;

use App\Entity\OrdeersDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdeersDetails>
 *
 * @method OrdeersDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdeersDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdeersDetails[]    findAll()
 * @method OrdeersDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdeersDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdeersDetails::class);
    }

//    /**
//     * @return OrdeersDetails[] Returns an array of OrdeersDetails objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdeersDetails
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
