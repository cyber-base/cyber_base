<?php

namespace App\Repository;
use App\Entity\Atelier;
use App\Entity\Planning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\Select;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Planning|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planning|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planning[]    findAll()
 * @method Planning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planning::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Planning $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Planning $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }




    // /**
    //  * @return Planning[] Returns an array of Planning objects
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
    public function findOneBySomeField($value): ?Planning
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // public function countUsagerByAtelier($atelier)
    // {
    //     return $this->createQueryBuilder('p')
    //         ->select('count(p.*)')
    //         ->setParameter('val', $atelier)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // public function countUsagerByLibelleAndDateAndHeure()
    // {
    //     $query = $this->getEntityManager()
    //         ->createQuery(
    //             "select a.heureDebut, a.libelle, a.date,count(p.id) from App\Entity\Planning p join App\Entity\Atelier a WITH p.id = a.id group by a.libelle,a.date,a.heureDebut  "
    //         );
    //     return $query->getResult();
    // }

    // public function countUsagerByAtelier()
    // {
    //     $query = $this->getEntityManager()
    //         ->createQuery(
    //             "select count(p.id) from App\Entity\Planning p join App\Entity\Atelier a WITH p.id = a.id group by a.libelle,a.date,a.heureDebut  "
    //         );
    //     return $query->getResult();
    // }

    

    public function findUsagerByAtelier($ateliers): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.ateliers = :id')
            ->setParameter('id', $ateliers)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllAtelier(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p, a')
            ->innerjoin('p.ateliers', 'a')
             ->groupBy('a.libelle, a.date, a.heureDebut')
             ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    public function countUsagerByAtelier(): array
    {
        return $this->createQueryBuilder('p')

        ->select('count(p)')
        ->innerJoin('p.ateliers', 'a')
        // ->innerjoin('p.usagers', 'u')
        // ->innerjoin('p.postes', 'po')
        // ->where('p.ateliers = :id')
        // ->setParameter('id', $idAtelier)
        ->groupBy('p.ateliers, a.date, a.heureDebut')
        ->orderBy('p.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;

    }

}
