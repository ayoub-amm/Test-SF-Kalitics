<?php
namespace App\Services;

use App\Entity\Pointages;
use Doctrine\ORM\EntityManagerInterface;

class DureeByuserInWeekService
{
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getDureeByuserInWeek(Pointages $pointages)
    {
        
        $dateTime = $pointages->getDate();
        $monday = clone $dateTime->modify(('Sunday' == $dateTime->format('l')) ? 'Monday last week' : 'Monday this week');
        $sunday = clone $dateTime->modify('Sunday this week'); 

        $result = $this->em->getRepository(Pointages::class)->getDureeByuserInWeek($pointages->getUtilisateur()->getId(),$monday->format('Y-m-d'),$sunday->format('Y-m-d'));
    
         return ($result + $pointages->getDuree()) ?? $pointages->getDuree();
        
    }

}
