<?php

namespace App\Repository;

use App\Entity\Champion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Champion>
 *
 * @method Champion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Champion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Champion[]    findAll()
 * @method Champion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChampionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Champion::class);
    }

    public function save(Champion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Champion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findWithCriteria($role, $searchField) {
        $queryBuilder = $this->createQueryBuilder('c'); //SELECT * FROM champions c

        if($searchField != null) {
            $queryBuilder->andWhere('c.name LIKE :searchFilter') // WHERE c.name LIKE %{searchField}%
                ->orWhere('c.description LIKE :searchFilter') // OR c.description LIKE %{searchField}%
                ->setParameter('searchFilter', '%'.$searchField.'%'); 
        }

        if($role != null) {
            $queryBuilder->andWhere('c.idMainRole = :mainRole')
                ->setParameter('mainRole', $role);
        }
        

        return $queryBuilder->getQuery()->getResult();
    }

//    /**
//     * @return Champion[] Returns an array of Champion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Champion
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
