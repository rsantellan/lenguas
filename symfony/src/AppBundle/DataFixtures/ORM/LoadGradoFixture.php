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
class LoadGradoFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 4;
    }

    private function allData(){
    	$data = [];
        $data[] = ['author' => 'AMODIO, MARIANA', 'year' => 2012, 'description' => '“La literatura como fuente para la Lingüística Histórica. Estudio del contacto histórico entre el español y el portugués. El caso de Pedro Leandro Ipuche, Serafín J. García y Julio C. da Rosa”.'];
        $data[] = ['author' => 'ALTESOR, MARÍA INÉS', 'year' => 2012, 'description' => '“Moda y vestimenta a través del léxico: el léxico de la vestimenta en el Montevideo del ochocientos”.'];
        $data[] = ['author' => 'BÉRTOLA, CECILIA', 'year' => 2012, 'description' => '“Filólogos naturalistas en la Banda Oriental en los siglos XVIII y XIX: estudio lingüístico comparativo entre el legado de un naturalista demarcador y el de un demarcador naturalista”.'];
        $data[] = ['author' => 'BÉRTOLA, CECILIA', 'year' => 2012, 'description' => '“Notas y definiciones de voces rioplatenses en viajeros y cronistas del Río de la Plata (siglos XVIII y XIX)”.'];
        $data[] = ['author' => 'CANALE, GERMÁN', 'year' => 2012, 'description' => '“Algunos fenómenos fonético-fonológicos en el español del Uruguay en la segunda mitad del XIX”.'];
        $data[] = ['author' => 'CUSATI, CLAUDIA', 'year' => 2012, 'description' => '“El cuerpo como recurso para el tratamiento grosero en la prensa de Montevideo entre 1870 y 1970″.'];
        $data[] = ['author' => 'ELENA, VIRGINIA', 'year' => 2012, 'description' => '“La toponimia como herramienta para la lingüística histórica: el caso de la toponimia guaraní en la historia del español del Uruguay”.'];
        $data[] = ['author' => 'FERNÁNDEZ GUERRA, AMPARO', 'year' => 2012, 'description' => '“El ‘otro’ lejano y próximo. Recorrido por la lexicografía uruguaya a partir de la comparación de definiciones en diccionarios uruguayos éditos e inéditos (Siglos XIX y XX)”.'];
        $data[] = ['author' => 'GALEOTTI, GABRIELLA', 'year' => 2012, 'description' => '“Análisis lingüístico de las fórmulas de tratamiento en cartas de la familia Brito del Pino (S.XIX)”.'];
        $data[] = ['author' => 'LÓPEZ FERNÁNDEZ, MARÍA CLAUDIA', 'year' => 2012, 'description' => '“El español de principios del siglo XIX a través del sainete ´El valiente fanfarrón y criollo socarrón´”.'];
        $data[] = ['author' => 'MÉNDEZ, MÓNICA', 'year' => 2012, 'description' => '“Estudio de formas verbales prospectivas del modo indicativo en el español del Uruguay en los siglos XVIII y XIX”.'];
        $data[] = ['author' => 'ORONOZ, LUJÁN', 'year' => 2012, 'description' => '“Presencia histórica de la lengua portuguesa en documentos del siglo XIX en la frontera Artigas-Quaraí”.'];
        $data[] = ['author' => 'SANTI, DIEGO', 'year' => 2012, 'description' => '“La presencia del portugués en la prensa escrita en la frontera uruguayo-brasileña (1895-1961). Análisis del periódico BRAZIL-URUGUAY, 1901″.'];
    	$data[] = ['author' => 'SOCA, RICARDO', 'year' => 2012, 'description' => '“Elementos compartidos con el portugués de Brasil en los cuentos de José Monegal”.'];
        

    	return $data;
    }
    public function load(ObjectManager $manager)
    {
    	foreach($this->allData() as $data){
    		$trabajo = new Trabajo();
    		$trabajo->setAuthors($data['author']);
    		$trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-trabajos-grado'));
    		$manager->persist($trabajo);
    	}
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}