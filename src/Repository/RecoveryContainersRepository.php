<?php

namespace App\Repository;

use App\Entity\RecoveryContainers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReocveryContainers>
 *
 * @method RecoveryContainers|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecoveryContainers|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecoveryContainers[]    findAll()
 * @method RecoveryContainers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecoveryContainersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecoveryContainers::class);
    }

    public function save(RecoveryContainers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecoveryContainers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ReocveryContainers[] Returns an array of ReocveryContainers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReocveryContainers
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
