<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;


class DocumentoService
{
    protected $em;

    protected $logger;

    public function __construct(EntityManagerInterface $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
        $this->logger->addDebug('Starting Documento Service');
    }

    public function retrieveAllDocumentsForMenu()
    {
    	$dql = 'select d.id, d.title, d.slug, d.orden from AppBundle:Documento d order by d.orden asc';
    	return $this->em->createQuery($dql)->getResult();
    }

    public function retrieveBySlug($slug)
    {
    	return $this->em->getRepository('AppBundle:Documento')->findOneBySlug($slug);
    }
}