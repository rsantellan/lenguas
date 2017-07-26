<?php

namespace AppBundle\Service;

#use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;

use AppBundle\Entity\Trabajo;

class TrabajosService
{
    protected $em;

    protected $logger;

    public function __construct(EntityManagerInterface $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->logger->addDebug('Starting Trabajos Service');
    }

    public function retrieveAllPublicaciones()
    {
    	$dql = 'select t from AppBundle:Trabajo t where t.type = :type order by t.authors asc, t.year asc';
    	return $this->em->createQuery($dql)->setParameters(['type' => Trabajo::PUBLICACION])->getResult();
    }

    public function retrieveAllPublicacionesPerLetter($mediaAlbumService = null)
    {
        return $this->sortTrabajosPerLetter($this->retrieveAllPublicaciones(), $mediaAlbumService);
    }

    private function sortTrabajosPerLetter($trabajos, $mediaAlbumService = null)
    {
        $returnData = [];
        foreach($trabajos as $trabajo)
        {
            $letter = strtoupper(substr($trabajo->getAuthors(), 0, 1));
            if(!isset($returnData[$letter])){
                $returnData[$letter] = [];
            }
            $toSend = ['trabajo' => $trabajo];
            if($mediaAlbumService != null){
                $toSend['files'] = $mediaAlbumService->retrieveAllFilesByObjectAndAlbum($trabajo->getFullClassName(), $trabajo->getId(), 'files');
            }
            $returnData[$letter][] = $toSend;
        }
        return $returnData;
    }

    public function retrieveAllMonografiasGrado()
    {
        $dql = 'select t from AppBundle:Trabajo t where t.type = :type order by t.authors asc';
        return $this->em->createQuery($dql)->setParameters(['type' => Trabajo::MONOGRAFIAGRADO])->getResult();
    }    

    public function retrieveAllMonografiasGradoPerLetter($mediaAlbumService = null)
    {
        return $this->sortTrabajosPerLetter($this->retrieveAllMonografiasGrado(), $mediaAlbumService);
    }

    public function retrieveAllMonografiasPosgrado()
    {
        $dql = 'select t from AppBundle:Trabajo t where t.type = :type order by t.authors asc';
        return $this->em->createQuery($dql)->setParameters(['type' => Trabajo::MONOGRAFIAPOSGRADO])->getResult();
    }    

    public function retrieveAllMonografiasPosgradoPerLetter($mediaAlbumService = null)
    {
        return $this->sortTrabajosPerLetter($this->retrieveAllMonografiasPosgrado(), $mediaAlbumService);
    }

    public function doSearch($keyword)
    {
        $dql = 'select t from AppBundle:Trabajo t where t.authors like :authors or t.description like :description or t.year like :year order by t.type';
        $searchWord = '%'.$keyword.'%';
        return $this->em->createQuery($dql)
                        ->setParameters(['authors' => $searchWord, 'description' => $searchWord, 'year' => $searchWord])
                        ->getResult();
    }
}