<?php

namespace App\Repository;

use App\Entity\PropertySearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PropertySearchType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertySearchType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertySearchType[]    findAll()
 * @method PropertySearchType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertySearchTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PropertySearchType::class);
    }

    // /**
    //  * @return PropertySearchType[] Returns an array of PropertySearchType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropertySearchType
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
