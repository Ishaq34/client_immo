<?php

namespace App\Repository;

use App\Entity\Immovable;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Immovable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Immovable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Immovable[]    findAll()
 * @method Immovable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImmovableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Immovable::class);
    }

    public function findAllVisibleQuery(PropertySearch $search)
    {
        $query = $this->findVisibleQuery();
        if($search->getPrestation()){
            $query = $query
                ->where('p.prestation = :prestation')
                ->setParameter('prestation', $search->getPrestation());
        }
        if($search->getType()){
            $query = $query
                ->andWhere('p.type = :type')
                ->setParameter('type', $search->getType());
        }
        if($search->getCity()){
            $query = $query
                ->innerJoin('p.address', 'c')
                ->andWhere('c.city = :city')
                ->setParameter('city', $search->getCity());
        }
        if($search->getMaxPrice()){
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        if($search->getMinArea()){
            $query = $query
                ->andWhere('p.area >= :minarea')
                ->setParameter('minarea', $search->getMinArea());
        }
        return $query->getQuery()
            ->getResult();
    }

    public function findByPrestationVisibleQuery(PropertySearch $search, $prestation)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.sold = false')
            ->andWhere('p.prestation = :prestation')
            ->setParameter('prestation', $prestation);

        if($search->getType()){
            $query = $query
                ->andWhere('p.type = :type')
                ->setParameter('type', $search->getType());
        }
        if($search->getCity()){
            $query = $query
                ->innerJoin('p.address', 'c')
                ->andWhere('c.city = :city')
                ->setParameter('city', $search->getCity());
        }
        if($search->getMaxPrice()){
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
        if($search->getMinArea()){
            $query = $query
                ->andWhere('p.area >= :minarea')
                ->setParameter('minarea', $search->getMinArea());
        }
        return $query->getQuery()
            ->getResult();
    }

    public function findAllWithPaginator(){
        return $this->createQueryBuilder('p')
            ->select('p')
            ->getQuery();
    }

    public function findLatest(){
        return $this->createQueryBuilder('p')
            ->orderBy('p.dateCreation', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }

    // /**
    //  * @return Immovable[] Returns an array of Immovable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Immovable
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
