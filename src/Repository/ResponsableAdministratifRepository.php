<?php

namespace App\Repository;

use App\Entity\ResponsableAdministratif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResponsableAdministratif>
 *
 * @method ResponsableAdministratif|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableAdministratif|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableAdministratif[]    findAll()
 * @method ResponsableAdministratif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableAdministratifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableAdministratif::class);
    }

    public function save(ResponsableAdministratif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ResponsableAdministratif $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
} 