<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Category;

/**
 * Description of LoadCategoriesFixture.
 *
 * @author Rodrigo Santellan
 */
class LoadCategoriesFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager)
    {
    	$categoryPublicaciones = new Category();
    	$categoryPublicaciones->setName('Publicaciones');
    	$categoryPublicaciones->setDescription('<p class="section-sub">Se incluyen aquí publicaciones académicas sobre temas relacionados con la historia de las lenguas en Uruguay, surgidas a partir de los años 90.</p><p class="section-sub">Agradecemos a los autores, editores y compiladores de estos trabajos que gentilmente nos permitieron su difusión a través de esta página.</p>');
    	$categoryPublicaciones->setType(Category::PUBLICACION);
    	$manager->persist($categoryPublicaciones);

    	$categoryTrabajosGrado = new Category();
    	$categoryTrabajosGrado->setName('Trabajos de Grado');
    	$categoryTrabajosGrado->setDescription('<p class="section-sub">Se publican aquí trabajos de investigación realizados por estudiantes en el marco del curso de grado (Lingüística Histórica, Seminarios, Taller metodológico). Agradecemos a los autores que generosamente nos permitieron su difusión.</p>');
    	$categoryTrabajosGrado->setType(Category::MONOGRAFIA);
    	$manager->persist($categoryTrabajosGrado);

    	$categoryTrabajosPosGrado = new Category();
    	$categoryTrabajosPosGrado->setName('Trabajos de Posgrado');
    	$categoryTrabajosPosGrado->setDescription('<p class="section-sub">Se publican aquí trabajos de investigación realizados en el marco del cursos de posgrado en la Universidad de la República o en otras universidades.  Agradecemos a los autores que generosamente nos permitieron su difusión. </p>');
    	$categoryTrabajosPosGrado->setType(Category::MONOGRAFIA);
    	$manager->persist($categoryTrabajosPosGrado);    	

    	$categoryGlosarioObras = new Category();
    	$categoryGlosarioObras->setName('Glosario de obras literarias');
    	$categoryGlosarioObras->setDescription('');
    	$categoryGlosarioObras->setType(Category::FUENTES);
    	$manager->persist($categoryGlosarioObras);

    	$categoryVocabulariosIndependientes = new Category();
    	$categoryVocabulariosIndependientes->setName('Vocabularios independientes');
    	$categoryVocabulariosIndependientes->setDescription('');
    	$categoryVocabulariosIndependientes->setType(Category::FUENTES);
    	$manager->persist($categoryVocabulariosIndependientes);

    	$categoryVocabulariosRiograndenses = new Category();
    	$categoryVocabulariosRiograndenses->setName('Vocabularios riograndenses');
    	$categoryVocabulariosRiograndenses->setDescription('<p class="section-sub">A quien se interese por el léxico del Río de la Plata puede resultarle valiosa la consulta de repertorios riograndenses. Se ofrecen a continuación las referencias de algunas obras de interés.</p>');
    	$categoryVocabulariosRiograndenses->setType(Category::FUENTES);
    	$manager->persist($categoryVocabulariosRiograndenses);

    	$categoryVocabulariosAfricanos = new Category();
    	$categoryVocabulariosAfricanos->setName('Vocabularios de voces de origen africano');
    	$categoryVocabulariosAfricanos->setDescription('<p class="section-sub">Afronegrismos rioplatenses.</p>');
    	$categoryVocabulariosAfricanos->setType(Category::FUENTES);
    	$manager->persist($categoryVocabulariosAfricanos);

    	$manager->flush();
    	
    	$this->addReference('category-publicaciones', $categoryPublicaciones);
    	$this->addReference('category-trabajos-grado', $categoryTrabajosGrado);
    	$this->addReference('category-trabajos-posgrado', $categoryTrabajosPosGrado);
    	$this->addReference('category-glosario-obras', $categoryGlosarioObras);
    	$this->addReference('category-vocabularios-independientes', $categoryVocabulariosIndependientes);
    	$this->addReference('category-vocabularios-riograndenses', $categoryVocabulariosRiograndenses);
    	$this->addReference('category-vocabularios-africanos', $categoryVocabulariosAfricanos);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}

