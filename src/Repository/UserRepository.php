<?php
// src/App/Repository/UserRepository.php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    
    public function getDeelnemers($activiteitid)
    {
        $em=$this->getEntityManager();

        
        $query=$em->createQuery("SELECT d FROM App:User d WHERE :activiteitid MEMBER OF d.activiteiten");

        $query->setParameter('activiteitid',$activiteitid);

        return $query->getResult();
    }
}