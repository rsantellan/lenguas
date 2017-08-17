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
class LoadPublicacionesFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 3;
    }

    private function allData(){
    	$data = [];
    	$data[] = ['author' => 'BÉRTOLA, CECILIA', 'year' => 2012, 'description' => '“Notas y definiciones de voces rioplatenses en viajeros y cronistas del Río de la Plata (siglos XVIII y XIX): primeros avances”. Ponencia leída en el VI Seminario sobre lexicología y lexocografía del español y del portugués americanos. Academia Nacional de Letras del Uruguay-Instituto de Lingüística de la Facultad de Humanidades y Ciencias de la Educación. Montevideo, 16 y 17 de octubre de 2012. Publicada en el sitio web de la Academia Nacional de Letras.'];
    	$data[] = ['author' => 'BÉRTOLA, CECILIA', 'year' => 2014, 'description' => '“Crónicas de viaje como fuentes lingüísticas: el aporte de Alcide D’Orbigny a la etnolingüística y la lexicografía”. En: Canale, G.y Ruel, V. (comps.) Lengua y cultura francesas en el Uruguay. Tradinco, Montevideo. 127-149. ISBN: 978-9974-99-584-0.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2000, 'description' => '“El imperfecto del subjuntivo: aspectos diacrónicos y sincrónicos”. Ponencia presentada en el Congreso de ALFAL, Santiago de Chile, 1999. Publicado en Ponencias de profesores uruguayos presentadas en los congresos de la UBA y de la ALFAL. Montevideo, Publicación de la Sociedad de Profesores de Español del Uruguay: pp. 11-19.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2007, 'description' => '”De los orígenes de gaucho: un vagabundo en fronteras inciertas”. Revista de la Academia Nacional de Letras del Uruguay. Año 2, No. 2: pp. 167-203.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2007, 'description' => '“La cuestión de vuestro/a(s): vitalidad medieval y clásica en el español del Uruguay” en V. Bertolotti et alii, Estudios de Lingüística Hispánica. Cádiz, Universidad de Cádiz: pp. 17-41.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2008, 'description' => '“El caso del falso Aparicio Saravia: análisis de dos cartas escritas en la frontera uruguayo-brasileña” en J. Espiga y A. Elizaincín (orgs.) Español y Portugués: um (velho) Novo Mundo de fronteiras e contatos. Pelotas, EDUCAT: pp. 299-318.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2010, 'description' => '“Notas sobre el che“. Lexis, vol. XXXIV (I): pp. 57-93.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2010, 'description' => '“La gramaticalización de usted: un cambio lingüístico en proceso. Evidencias en el Uruguay del siglo XIX”. Filologia Linguística Portuguesa, n. 12 (1): pp. 149-177.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2010, 'description' => '“Un viaje al pasado lingüístico de la región: el Voyage à Rio-Grande do Sul de Auguste de Saint-Hilaire” en Bernabé, J.-Ph.; Cordery, L. y B. Vegh (coords.) Los viajeros y el Río de la Plata: un siglo de escritura. Montevideo: Linardi y Risso: pp. 265-278.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2011, 'description' => '“La peculiaridad del sistema alocutivo singular en Uruguay” en Ángela Di Tullio y Rolf Kailuweit (eds.) El español rioplatense: lengua, literatura, expresiones culturales. Madrid, Iberoamericana – Vervuert: pp. 23-47.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2011, 'description' => 'Los cambios en la segunda persona del singular durante el siglo XIX en el español del Uruguay. Tesis doctoral, Universidad Nacional de Rosario (República Argentina).'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA', 'year' => 2011, 'description' => '“Testimonios para el estudio histórico de la lengua portuguesa en el Uruguay”. Lingüística 15/16 (2003-2004): pp. 99-122.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA / SERRANA, CAVIGLIA / MAGDALENA COLL', 'year' => 2012, 'description' => '“Los cambios de las formas de tratamiento en la ruptura del orden colonial: un aporte a la historia de la lengua española en el Uruguay” en A. Frega y A. Islas (comps.) Nuevas miradas y debates en torno al Artiguismo. Montevideo, Departamento de Publicaciones de la Facultad de Humanidades y Ciencias de la Educación: pp. 211-234.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA / MAGDALENA COLL', 'year' => 2006, 'description' => '“Apuntes sobre el español en el Uruguay: historia y rasgos caracterizadores”. Ámbitos (2ª época), núm. 16: pp. 31-40.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA / MAGDALENA COLL', 'year' => 2010, 'description' => '“La historia lingüística del Uruguay: fuentes, resultados, perspectivas” en Cristina Pípolo y Adriana Uribarrí (comps.) Español en cambio. ANEP CoDiCen DFPD – IPA, Departamento de Español, Montevideo: pp. 47-71.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA / MAGDALENA COLL', 'year' => 2012, 'description' => '“Reflexiones sobre la lengua en América” en Zamorano Aguilar (coord. y ed.) Reflexión lingüística y lengua en la España del siglo XIX: marcos, panoramas y nuevas aportaciones. Lincom, München: pp. 443-466.'];
    	$data[] = ['author' => 'BERTOLOTTI, VIRGINIA / MAGDALENA COLL', 'year' => 2013, 'description' => 'Contacto y pérdida: el español y las lenguas indígenas en el Río de la Plata entre los siglos XVI y XIX. Boletín de Filología, 48 (2), Pág. 11 – 30.'];
    	$data[] = ['author' => 'CAVIGLIA, SERRANA / MARIANELA FERNÁNDEZ', 'year' => 2007, 'description' => '“Léxico y contacto: una muestra del acervo léxico compartido entre el Portugues de Río Grande del Sur y el Español del Uruguay”. Revista de la Academia Nacional de Letras, año 2, Nº 3: pp. 157-177.'];
    	$data[] = ['author' => 'COLL, MAGDALENA', 'year' => 1994, 'description' => '“La Banda Oriental en el siglo XVIII: usos, desarrollo y difusión de la lengua escrita”. Anuario de Lingüística Hispánica, 10: pp. 25-37.'];
    	$data[] = ['author' => 'COLL, MAGDALENA', 'year' => 2008, 'description' => '“Estudios sobre la historia del portugués en el Uruguay: estado de la cuestión” en Espiga, J. y A. Elizaincín (orgs.) Español y Portugués: um (velho) Novo Mundo de fronteiras e contatos. Pelotas, EDUCAT: pp. 23-64.'];
    	$data[] = ['author' => 'COLL, MAGDALENA', 'year' => 2010, 'description' => '“Dime cómo hablábamos en los siglos XVIII y XIX y te diré cómo hablamos hoy” en Portal Uruguay Cultural (www.portaluruguaycultural.gub.uy).'];
    	$data[] = ['author' => 'COLL, MAGDALENA', 'year' => 2012, 'description' => '“Léxico de origen indígena y africano en dos escritores montevideanos de principios del siglo XIX: la mirada de José M. Pérez Castellano y Dámaso A. Larrañaga”. Stockholm Review of Latin American Studies: No. 8 (March 2012): pp. 49-64.'];
    	$data[] = ['author' => 'COLL, MAGDALENA / MARISA MALCUORI', 'year' => 1994, 'description' => '“Algunas observaciones sobre la escritura del español de la Banda Oriental en el siglo XVIII” en C. Hipogrosso y A. Pedretti (comps.) La escritura del español. Montevideo, Facultad de Humanidades y Ciencias de la Educación: pp. 37-51.'];
    	$data[] = ['author' => 'DA ROSA, JUAN JUSTINO', 'year' => 2013, 'description' => '“Historiografía lingüística del Río de la Plata: las lenguas indígenas de la Banda Oriental. Boletín de Filología“, 48 (2), Pág. 131 – 171.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 1992, 'description' => '“Historia del español en el Uruguay” en C. Hernández (comp.) Historia y presente del español en América. Madrid, Junta de Castilla y León & Pabecal: pp. 743-758.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 1995, 'description' => '“La interpretación en la lingüística histórica: la Banda Oriental del siglo XVIII”. Cuadernos Americanos, Nº 52, vol. 4: pp. 213-222.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 1997, 'description' => '“Los tratamientos tuteantes y voseantes en el español de la Banda Oriental (siglo XVIII)” en L. E. Behares y O. Cures (orgs.) Sociedad y cultura en el Montevideo colonial. Montevideo, FHCE – IMM: pp. 159-167.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 2002, 'description' => '“Diacronía del contacto español-portugués” en Norma Díaz, Ralph Ludwig, Stefan Pfänder (orgs.) La Romania Americana. Procesos lingüísticos en situaciones de contacto. Madrid/Frankfurt, Vervuert Iberoamericana: pp. 255-261.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 2002, 'description' => '“Port. Você / Va(n)cê y A gente en perspectiva histórica comparada con el español” en Wesch, A. / Weidenbusch, W. / Kailuweit, R. / Laca, B. (eds.): Sprachgeschichte als Varietätengeschichte. Historia de las variedades lingüísticas. Anlässlich des 60. Geburtstages von Jens Lüdtke. Tübingen: Stauffenburg: pp. 295-301.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 2011, 'description' => '“Motivación y origen de los cambios lingüísticos” en González, María José y Cristina Pippolo (comps.) Español al Sur. Montevideo, Luscinia Ediciones: pp. 257-289.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO', 'year' => 1992, 'description' => '“La correspondencia familiar como documento para la lingüística histórica”, Scripta Philologica in honorem J. M. Lope Blanch, UNAM: pp. 271-284.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO / MIRTA GROPPI / MARISA MALCUORI / MAGDALENA COLL', 'year' => 1997, 'description' => '“Aspectos fónicos del español de la Banda Oriental en el siglo XVIII”. Lingüística, 9: pp. 75-87.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO / MARISA MALCUORI / MAGDALENA COLL', 'year' => 1997, 'description' => '“A cuio tempo la dha mi muger’: notas sobre la sintaxis de la modificación nominal en la Banda Oriental del siglo XVIII”. Lingüística, 9: pp. 97-109.'];
    	$data[] = ['author' => 'ELIZAINCÍN, ADOLFO / MARISA MALCUORI / MAGDALENA COLL', 'year' => 1998, 'description' => '“Grafemática histórica: seseo y yeísmo en el Río de la Plata” en José Manuel Blecua, Juan Gutiérrez y Lidia Sala (eds.) Estudios de Grafemática en el Dominio Hispánico. Salamanca: Universidad de Salamanca / Instituto Caro y Cuervo: pp. 75-83.'];
    	$data[] = ['author' => 'FERNÁNDEZ, MARIANELA', 'year' => 2008, 'description' => '“El contacto portugués-español en el siglo XIX: primeros testimonios del yeísmo rehilado en suelo oriental” en J. Espiga y A. Elizaincín (orgs.) Español y Portugués: um (velho) Novo Mundo de fronteiras e contatos. Pelotas, EDUCAT: pp. 319-350.'];
    	$data[] = ['author' => 'GONZÁLEZ TORRES, ESTELA', 'year' => 2013, 'description' => 'Rasgos de oralidad en el español uruguayo de los siglos XVIII y XIX. Trabajo de fin de Máster, Máster de Estudios superiores de Lengua española: investigación y aplicaciones, Universidad de Granada.'];
    	$data[] = ['author' => 'GROPPI, MIRTA', 'year' => 1993, 'description' => '“Observaciones sobre algunas formas verbales en un corpus del siglo XIX” en Elizaincín, A. (comp.) Estudios sobre el español del Uruguay (II). Montevideo, FHCE: pp. 79-101.'];
    	$data[] = ['author' => 'GROPPI, MIRTA / VANNI CEBALLOS BEATRIZ', 'year' => 2008, 'description' => '“Representaciones dramáticas de una variable lingüística. Tuteo y voseo en obras de teatro del Río de la Plata (1886-1911)”. Spanish in Context, 5:8: pp. 64-88.'];
    	$data[] = ['author' => 'MOYNA, MARÍA IRENE', 'year' => 2009, 'description' => '“Child Acquisition and Language Change: Voseo Evolution in Río de la Plata Spanish.” Proceedings of the 2007 Hispanic Linguistics Symposium. Joe Collentine, Barbara Lafford, MaryEllen García, and Francisco Marcos Marín (eds.), Somerville, Cascadilla: pp. 131-142.'];
    	$data[] = ['author' => 'POLAKOF, ANA CLARA', 'year' => 2007, 'description' => 'El español del siglo XVIII en la Villa de San Carlos. Montevideo, Facultad de Humanidades y Ciencias de la Educación.'];
    	$data[] = ['author' => 'RAMÍREZ LUENGO, JOSÉ LUIS', 'year' => 2001, 'description' => '“Alternancia de las formas –ra/–se en el español uruguayo del siglo XIX”. Estudios Filológicos, 36: pp. 173–186.'];
    	$data[] = ['author' => 'RAMÍREZ LUENGO, JOSÉ LUIS', 'year' => 2002, 'description' => '“El futuro del subjuntivo en la Banda Oriental del siglo XVIII”. Revista de Filología, 20: pp. 305-317.'];
    	$data[] = ['author' => 'RAMÍREZ LUENGO, JOSÉ LUIS', 'year' => 2004, 'description' => '“Variación diastrática en la historia del español: algunos ejemplos del Uruguay del siglo XIX”. Boletín de la Real Academia Española, Tomo LXXXIV – Cuaderno CCXC (julio-diciembre 2004): pp. 307-330.'];
    	$data[] = ['author' => 'RAMÍREZ LUENGO, JOSÉ LUIS', 'year' => 2004, 'description' => '“Contacto hispano–portugués en la Romania Nova: aproximación a la influencia portuguesa en el español uruguayo del siglo XIX”, Res Diachronicae Digital, 4: El contacto de lenguas (monográfico coordinado por A. García Lenza y A. Rodríguez Barreiro): pp. 115-132.'];
    	$data[] = ['author' => 'RAMÍREZ LUENGO, JOSÉ LUIS', 'year' => 2006, 'description' => '“Una nota de sociolingüística histórica: el diminutivo en el español uruguayo del siglo XIX”. Res Diachronicae Digital, 5: pp. 39–45.'];
    	$data[] = ['author' => 'RAMÍREZ LUENGO, JOSÉ LUIS', 'year' => 2007, 'description' => '“Un aporte para la datación del yeísmo rehilado en el español del Uruguay”. Boletín de la Real Academia Española, Tomo LXXXVII – Cuaderno CCXVI, (julio-diciembre 2007): pp. 325-333.'];
    	$data[] = ['author' => 'RIZOS JIMÉNEZ, CARLOS ÁNGEL', 'year' => 2000, 'description' => '“Rasgos coloquiales en la correspondencia familiar uruguaya entre 1800 y 1840”. Estudios Filológicos, 35: pp. 104-122.'];

    	return $data;
    }
    public function load(ObjectManager $manager)
    {
    	foreach($this->allData() as $data){
    		$trabajo = new Trabajo();
    		$trabajo->setAuthors($data['author']);
    		$trabajo->setDescription($data['description']);
    		$trabajo->setYear($data['year']);
            $trabajo->setCategory($this->getReference('category-publicaciones'));
    		$manager->persist($trabajo);
    	}
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}