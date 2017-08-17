<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Trabajo;

/**
 * Description of LoadPublicacionesFixture.
 *
 * @author Rodrigo Santellan
 */
class LoadPosgradoFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 4;
    }

    private function allData()
    {
        $data = [];
        $data[] = ['author' => 'DA SILVA, ALINEA S.', 'year' => 2012, 'description' => '“Entre correspondências e interferências: o tratamento na região fronteiriça Uruguai-Brasil no século XIX.'];

        return $data;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->allData() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-trabajos-posgrado'));
            $manager->persist($trabajo);
        }
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
