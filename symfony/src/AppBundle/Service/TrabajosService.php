<?php

namespace AppBundle\Service;

//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use AppBundle\Entity\Trabajo;
use AppBundle\Entity\Category;

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

    public function retrieveAllOfCategory(Category $category)
    {
        $dql = 'select t from AppBundle:Trabajo t where t.category = :category order by t.authors asc, t.year asc';

        return $this->em->createQuery($dql)->setParameters(['category' => $category])->getResult();
    }

    public function retrieveAllOfCategoryPerLetter(Category $category, $mediaAlbumService = null)
    {
        return $this->sortTrabajosPerLetter($this->retrieveAllOfCategory($category), $mediaAlbumService);
    }

    private function sortTrabajosPerLetter($trabajos, $mediaAlbumService = null)
    {
        $returnData = [];
        foreach ($trabajos as $trabajo) {
            $letter = strtoupper(substr($trabajo->getAuthors(), 0, 1));
            if (!isset($returnData[$letter])) {
                $returnData[$letter] = [];
            }
            $toSend = ['trabajo' => $trabajo];
            if ($mediaAlbumService != null) {
                $toSend['files'] = $mediaAlbumService->retrieveAllFilesByObjectAndAlbum($trabajo->getFullClassName(), $trabajo->getId(), 'files');
            }
            $returnData[$letter][] = $toSend;
        }

        return $returnData;
    }

    public function doSearch($keyword, $mediaAlbumService = null)
    {
        $dql = 'select t,c from AppBundle:Trabajo t join t.category c where t.authors like :authors or t.description like :description or t.year like :year order by t.category';
        $searchWord = '%'.$keyword.'%';
        $data = $this->em->createQuery($dql)
                        ->setParameters(['authors' => $searchWord, 'description' => $searchWord, 'year' => $searchWord])
                        ->getResult();
        $returnData = [];
        foreach ($data as $trabajo) {
            if (!isset($returnData[$trabajo->getCategory()->getName()])) {
                $returnData[$trabajo->getCategory()->getName()] = [];
            }
            $returnData[$trabajo->getCategory()->getName()][] = $trabajo;
        }
        $orderByLetter = [];
        foreach ($returnData as $name => $trabajos) {
            $orderByLetter[$name] = $this->sortTrabajosPerLetter($trabajos, $mediaAlbumService);
        }

        return $orderByLetter;
    }
}
