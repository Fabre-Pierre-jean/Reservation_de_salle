<?php

namespace AppBundle\Repository;

/**
 * PromoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromoRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByNameAsc()
    {
        //SELECT nom FROM Auteur a ORDER BY a.nom ASC
//$qb =$this->createQueryBuilder('a')
//    ->orderBy('a.nom', 'ASC')
//    ->getQuery();
//var_dump($qb);die;

        return $this->createQueryBuilder('a')
            ->orderBy('a.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
