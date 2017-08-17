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
class LoadFuentesCategoriasFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 8;
    }

    private function allDataGlosario()
    {
        $data = [];
        $data[] = ['author' => 'ACEVEDO DÍAZ, EDUARDO:', 'year' => 2012, 'description' => 'Nativa [1890]. Aclaración de las voces locales usadas en esta obra, para la mejor inteligencia de los lectores extraños al país'];
        $data[] = ['author' => 'ASCASUBI, Hilario:', 'year' => 2012, 'description' => 'Aniceto Gallo: gacetero y gauchipoeta argentino [1872]'];
        $data[] = ['author' => 'ASCASUBI, Hilario:', 'year' => 2012, 'description' => 'Paulino Lucero o Los gauchos del Río de la Plata cantando y combatiendo contra los tiranos de la República Argentina y oriental del Uruguay (1839 a 1851) [1872]'];
        $data[] = ['author' => 'ASCASUBI, Hilario:', 'year' => 2012, 'description' => 'Santos Vega o Los mellizos de la flor: rasgos dramáticos de la vida del gaucho en las campañas y praderas de la República Argentina (1778-1808) [1872]'];
        $data[] = ['author' => 'ECHEVERRÍA, ESTEBAN:', 'year' => 2012, 'description' => 'La cautiva [1837]'];
        $data[] = ['author' => 'FERNÁNDEZ Y MEDINA, BENJAMÍN:', 'year' => 2012, 'description' => 'Cuentos [1892, 1893, 1923]'];
        $data[] = ['author' => 'HIDALGO, BARTOLOMÉ:', 'year' => 2012, 'description' => 'UN GAUCHO DE LA GUARDIA DEL MONTE CONTESTA AL MANIFIESTO DE FERNANDO VII. Y SALUDA AL CONDE DE CASA FLORES CON EL SIGUIENTE CIELITO, ESCRITO EN SU IDIOMA [HIDALGO, Bartolomé, Obra completa, Colección de Clásicos Uruguayos, vol. 170, Montevideo, 1986]'];
        $data[] = ['author' => 'LAMAS ANDRÉS Y OTROS:', 'year' => 2012, 'description' => 'Colección de poetas del Río de la Plata [1842?]'];
        $data[] = ['author' => 'MAGARIÑOS CERVANTES, ALEJANDRO:', 'year' => 2012, 'description' => 'Celiar, leyendar americana en variedad de metros [1852]'];
        $data[] = ['author' => 'MAGARIÑOS CERVANTES, ALEJANDRO:', 'year' => 2012, 'description' => 'Palmas y Ombúes [1884]'];
        $data[] = ['author' => 'SOTO Y CALVO, FRANCISCO:', 'year' => 2012, 'description' => 'Nastasio [1899]'];
        $data[] = ['author' => 'TISCORNIA, ELEUTERIO:', 'year' => 2012, 'description' => 'Vocabulario [HERNÁNDEZ, J., Martín Fierro, CONI, Buenos Aires, 1951.]'];
        $data[] = ['author' => 'OZORRILLA DE SAN MARTÍN, JUAN:', 'year' => 2012, 'description' => 'Tabaré [1888]'];
        return $data;
    }

    private function allDataIndependientes()
    {
        $data = [];
        $data[] = ['author' => 'BARCIA, PEDRO LUIS:', 'year' => 2012, 'description' => 'Un inédito Diccionario de argentinismos del siglo XIX, Academia Argentina de Letras, Buenos Aires, 2006'];
        $data[] = ['author' => 'MUÑIZ, FRANCISCO JAVIER:', 'year' => 2012, 'description' => 'Voces usadas con generalidad en las Repúblicas del Plata, la Argentina y la Oriental del Uruguay [1845], en: CHÁVEZ, F., Historia y Antología de la Poesía Gauchesca, Margus, Buenos Aires, 2004.'];
        $data[] = ['author' => 'TRELLES, MANUEL RICARDO:', 'year' => 2012, 'description' => 'Colección de voces americanas [1853], en: WEINBERG, F., “Un olvidado vocabulario americanista de 1853“, THESAURUS, Tomo XXXI, Número 3, 1976.'];
        return $data;
    }

    private function allDataRiograndeses()
    {
        $data = [];
        $data[] = ['author' => 'ALVARES PEREIRA CORUJA, ANTONIO:', 'year' => 2012, 'description' => 'Antonio. 1948. “Coleção de vocábulos e frases usados na Província de São Pedro do Rio Grande do Sul”. Anotado por el Prof. Walter Spalding. Instituto de Estudios Superiores de Montevideo, Boletín de Filología. Tomo V- N.os 37-38-39, marzo-junio-setiembre, de 1948, Montevideo. Páginas 113 a 384.'];
        $data[] = ['author' => 'ALVARES PEREIRA CORUJA, ANTONIO:', 'year' => 2012, 'description' => '1856. Collecção de vocabulos e frases usados na provincia de S. Pedro do Rio Grande do Sul no Brazil. Londes: Trübner e comp.'];
        $data[] = ['author' => 'CALLAGE, ROQUE:', 'year' => 2012, 'description' => '1926. Vocabulário Gaúcho. Porto Alegre: Livraria do Globo.'];
        $data[] = ['author' => 'CARDOSO NUNES, Z. y CARDOSO NUNES, R.:', 'year' => 2012, 'description' => '1990. Dicionário de Regionalismos do Rio Grande do Sul. Porto Alegre: Martins Livreiro – Editor. [4ª ed.]'];
        $data[] = ['author' => 'DE MORAES, LUIZ CARLOS:', 'year' => 2012, 'description' => '1935. Vocabulário Sul-rio-grandense. Porto Alegre: Livraria do Globo.'];
        $data[] = ['author' => 'DE OLIVEIRA, ALBERTO JUVENAL:', 'year' => 2012, 'description' => '2003. Dicionário Gaúcho. Porto Alegre: AGE Editora.'];
        $data[] = ['author' => 'SALLES, VICENTE:', 'year' => 2012, 'description' => '2003. Vocabulário crioulo. Contribuição do negro ao falar regional amazônico. Belem: IAP, Programa Raízes.'];
        $data[] = ['author' => 'VV. AA.: ', 'year' => 2012, 'description' => 'Vocabulário sul-rio-grandense. Rio de Janeiro-Pôrto Alegre-São Paulo: Editôra Globo. [Reúne quatro obras em um único dicionario de vocábulos rio-grandenses: Vocabulario sul-rio-grandense, de Romaguera Corrêa; Coleção de vocábulos na província do Rio Grande do Sul, de Antônio Álvares Pereira Coruja; Vocabulário sul-rio-grandense, de Luiz Carlos de Moraes; Vocabulário gaúcho, de Roque Callage. Contém ainda verbetes de Aurélio Buarque de Hollanda, Pe. Carlos Teschauer, Beaurepaire-Rohan, Darcy Azambuja e Vieira Pires.]'];
        return $data;
    }


    private function allDataAfricanos()
    {
        $data = [];
        $data[] = ['author' => 'LAGUARDA TRÍAS, ROLANDO, A.:', 'year' => 2012, 'description' => '“Afronegrismos rioplatenses” (1969). Tomo XLIX, Cuaderno CLXXXVI -Enero-Abril (1969). Separata del Boletín de la RAE. Madrid'];
        return $data;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->allDataGlosario() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-glosario-obras'));
            $manager->persist($trabajo);            
        }
        foreach ($this->allDataIndependientes() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-vocabularios-independientes'));
            $manager->persist($trabajo);
        }

        foreach ($this->allDataRiograndeses() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-vocabularios-riograndenses'));
            $manager->persist($trabajo);
        }
        foreach ($this->allDataAfricanos() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-vocabularios-africanos'));
            $manager->persist($trabajo);
        }
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
