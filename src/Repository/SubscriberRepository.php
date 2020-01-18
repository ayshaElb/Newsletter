<?php

namespace App\Repository;

use App\Entity\Subscriber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Subscriber|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscriber|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscriber[]    findAll()
 * @method Subscriber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscriberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscriber::class);
    }

    /**
     * @return Subscriber[] Returns an array of subscribers
     */
    public function findAllEmailsSubcriber()
    {
        return $this->createQueryBuilder('u')
            ->select('u.email')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllEmailsSubcriberByNewsletter()
    {
        return $this->createQueryBuilder('u')
            ->select('u.email')
            ->where('u.types.id LIKE  :id')
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * findSubscriberByNewsletter
     *
     * @param mixed $id
     * @return void
     */
    public function findSubscriberByNewsletter($id)
    {
        return $this->createQueryBuilder('u')
            ->select('u.email')
            ->join('u.types', 't')
            ->where('t.id LIKE :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
        

        
    }

    

    // /**
    //  * @return Subscriber[] Returns an array of Subscriber objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subscriber
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
