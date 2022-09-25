<?php

namespace App\Repository;

use App\Entity\NewContainersMovements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NewContainersMovements>
 *
 * @method NewContainersMovements|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewContainersMovements|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewContainersMovements[]    findAll()
 * @method NewContainersMovements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewContainersMovementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewContainersMovements::class);
    }

    public function save(NewContainersMovements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NewContainersMovements $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return NewContainersMovements [] Returns an array of NewContainersMovements objects
     */
    public function containersVolumeRest(): array
    {
        return $this->createQueryBuilder('n')
            ->select('(n.new_container) AS container , SUM(n.quantity_injected) AS totalQ ')
            ->leftJoin('n.new_container', 'c')
            ->andWhere('c.return_date IS NULL')
            ->orderBy('n.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?NewContainersMovements
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
