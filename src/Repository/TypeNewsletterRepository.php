<?php

namespace App\Repository;

use App\Entity\TypeNewsletter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeNewsletter|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNewsletter|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNewsletter[]    findAll()
 * @method TypeNewsletter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNewsletterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNewsletter::class);
    }

    
    // /**
    //  * @return TypeNewsletter[] Returns an array of TypeNewsletter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeNewsletter
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
