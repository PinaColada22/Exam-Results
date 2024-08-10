<?php

namespace App\Repository;

use App\Entity\ExamResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExamResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamResult[]    findAll()
 * @method ExamResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamResult::class);
    }

    //    /**
    //     * @return ExamResult[] Returns an array of ExamResult objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Subject
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

