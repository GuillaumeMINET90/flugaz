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
//     * @return RecoveryContainers[] 
//     */
//     public function containersVolumeRecover(): array
//     {
//         return $this->createQueryBuilder('r')
//             ->select('(c.recovery_container) AS container , SUM(r.quantity_injected) AS totalQ ')
//             ->leftJoin('r.new_container', 'c')
//             ->andWhere('c.return_date IS NULL')
//             ->groupBy('r.new_container')
//             ->getQuery()
//             ->getResult()
//         ;
//     }
   

//    public function findOneBySomeField($value): ?RecoveryContainers
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
