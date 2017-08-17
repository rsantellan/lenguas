<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use AppBundle\Entity\Category;

class CategoriesService
{
    protected $em;

    protected $logger;

    public function __construct(EntityManagerInterface $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->logger->addDebug('Starting Category Service');
    }

    public function retrieveForMenu($keyIsName = true)
    {
        $dql = 'select c.id, c.name, c.slug, c.type from AppBundle:Category c order by c.type asc, c.orden asc';
        $data = $this->em->createQuery($dql)->getResult();
        $returnData = [];
        foreach ($data as $category) {
            $key = $category['type'];
            if ($keyIsName) {
                $key = Category::getNameOfType($category['type']);
            }
            if (!isset($returnData[$key])) {
                $returnData[$key] = [];
            }
            $returnData[$key][] = $category;
        }

        return $returnData;
    }

    public function retrieveForMenuByType($type)
    {
        $dql = 'select c.id, c.name, c.slug, c.type, c.longname from AppBundle:Category c where c.type = :type order by c.type asc, c.orden asc';

        return  $this->em->createQuery($dql)->setParameters(['type' => $type])->getResult();
    }

    public function retrieveBySlug($slug)
    {
        return $this->em->getRepository('AppBundle:Category')->findOneBy(['slug' => $slug]);
    }
}
