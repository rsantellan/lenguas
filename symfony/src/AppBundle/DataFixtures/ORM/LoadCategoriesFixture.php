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

        $categoryLenguasIndigenas = new Category();
        $categoryLenguasIndigenas->setName('Lenguas Indigenas');
        $categoryLenguasIndigenas->setLongname('Materiales vinculados a las lenguas indígenas en el Uruguay');
        $categoryLenguasIndigenas->setType(Category::OTROS);
        $manager->persist($categoryLenguasIndigenas);

        $categoryLenguasAfricanas = new Category();
        $categoryLenguasAfricanas->setName('Lenguas Africanas');
        $categoryLenguasAfricanas->setLongname('Materiales vinculados a las lenguas indígenas en el Uruguay');
        $categoryLenguasAfricanas->setDescription('<p class="section-sub">Para estudiar la presencia y el contacto de lenguas africanas así como la representación del habla de los africanos y sus descendientes en Montevideo en el siglo XIX, nos han sido de gran interés materiales y textos a los que accedimos a través de Ayestarán (1953), Goldman (1997, 2008a, 2008b y 2008c), Montaño (1997, 2008), etc. Divulgamos aquí fotografías o escaneos de los originales de estos textos, que se conservan en la Biblioteca Nacional[1], ya que el acceso directo a los originales permite un análisis lingüístico más fiable.</p>');
        $categoryLenguasAfricanas->setType(Category::OTROS);
        $manager->persist($categoryLenguasAfricanas);

    	$manager->flush();
    	
    	$this->addReference('category-publicaciones', $categoryPublicaciones);
    	$this->addReference('category-trabajos-grado', $categoryTrabajosGrado);
    	$this->addReference('category-trabajos-posgrado', $categoryTrabajosPosGrado);
    	$this->addReference('category-glosario-obras', $categoryGlosarioObras);
    	$this->addReference('category-vocabularios-independientes', $categoryVocabulariosIndependientes);
    	$this->addReference('category-vocabularios-riograndenses', $categoryVocabulariosRiograndenses);
        $this->addReference('category-vocabularios-africanos', $categoryVocabulariosAfricanos);
        $this->addReference('category-lenguas-indigenas', $categoryLenguasIndigenas);
    	$this->addReference('category-lenguas-africanas', $categoryLenguasAfricanas);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}

