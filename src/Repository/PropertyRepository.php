<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\PropertySearch;
/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Property[]
     */
    //on trouve des donnees de type PropertySearch
    public function findAllVisibleQuery(PropertySearch $search): array
    {
        // on sauvegarde la requete dans le $query
        $query = $this->findVisibleQuery();

        // test si les prix de bd sont egal ou infer ou prix de la recherche
            if ($search->getMaxPrice())
            {
                $query = $query
                ->andwhere('p.price <= :maxprice')
                // donner une valeur a maxprice
                ->setParameter('maxprice', $search->getMaxPrice());
            }
           
        // test si les suraces de bd sont sup ou egal ou sur de la recherche
            if ($search->getMinSurface())
            {
                $query = $query
                ->andwhere('p.surface >= :minsurface' )
                ->setParameter('minsurface', $search->getMinSurface());
            }

        // on return la requete en transformant la resultat en query
        return $query->getQuery()->getResult();
        ;
    }

    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult()
        ;
    }

    //function recupere des biens avec solde false
    private function findVisibleQuery()
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.sold = false')
        ;

    }


    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
