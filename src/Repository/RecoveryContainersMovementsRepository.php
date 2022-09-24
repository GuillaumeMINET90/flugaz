<?php

namespace App\Repository;

use App\Entity\RecoveryContainersMovements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecoveryContainersMovements>
 *
 * @method RecoveryContainersMovements|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecoveryContainersMovements|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecoveryContainersMovements[]    findAll()
 * @method RecoveryContainersMovements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecoveryContainersMovementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecoveryContainersMovements::class);
    }

    public function save(RecoveryContainersMovements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RecoveryContainersMovements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RecoveryContainersMovements[] Returns an array of RecoveryContainersMovements objects
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

//    public function findOneBySomeField($value): ?RecoveryContainersMovements
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
