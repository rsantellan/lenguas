<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Documento;

/**
 * Description of LoadPublicacionesFixture.
 *
 * @author Rodrigo Santellan
 */
class LoadDocumentosFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 6;
    }

    private function allData(){
    	$data = [];
        $data[] = ['title' => 'Documentos siglo XVIII', 'body' => '<h2 class="section-title text-uppercase section-sub">Presentación</h2>
                  <p class="section-sub">Este volumen recoge textos escritos durante el siglo XVIII por habitantes del territorio que ahora llamamos Uruguay.</p>
                  <p class="section-sub">El español en Hispanoamérica es la lengua de cultura, la lengua de la administración, de la educación, de la religión y también la de los afectos y la de las tradiciones. Es esa lengua la que nos permite reconocernos como iguales pero también como diferentes y el conocimiento de subhistoria, como el conocimiento arqueológico, como el conocimiento genético, permite y permitirá ahondar en la historia de nuestra identidad.</p>
                  <p class="section-sub">El español de este lado del Atlántico no se constituyó de manera abrupta, por cierto. Fue a través de la resignificación de palabras ya existentes o a través de la creación de nuevas, ya que nueva era la realidad que había que nombrar. Fue a través de pequeños cambios en construcciones sintácticas. Fue a través de preferencias de los hablantes por una forma para decir algo más que por otra, por una forma de pronunciar más que por otra. Todo ello llevó a la cristalización de caminos separados pero que se entrecruzan en nuestra América, tan igual y tan distinta.</p>
                  <p class="section-sub">Desde hace unos años, lenta y fragmentariamente, la lingüística ha comenzado a ocuparse de esa historia del español en América. Uno de los obstáculos con los que se ha encontrado ha sido la ausencia de una infraestructura sólida que permita la reconstrucción de la historia lingüística americana y que permita responder a la pregunta esencial de por qué somos como somos, o por qué hablamos como hablamos. La infraestructura en cuestión se conforma con documentación fiable para el estudio de la fonología, de la morfología, de la sintaxis, del léxico y del entramado discursivo del español americano. Huelga decir que esta documentación es además de innegable interés para quienes desde otras disciplinas se ocupan de la vida cotidiana, de las formas de sentir y de pensar de los americanos de épocas pasadas...</p>'];
        $data[] = ['title' => 'Documentos siglo XIX', 'body' => '<h2 class="section-title text-uppercase section-sub">Presentación</h2>
                  <p class="section-sub">Quinientos veinte años atrás la lengua española se escuchaba por primera vez en territorio americano. Aquel puñado de hablantes estaba muy lejos de sospechar que alrededor de veinte generaciones después esa lengua habría de llegar a ser hablada por cientos de millones de personas a ambos lados del Atlántico.</p>
                  <p class="section-sub">Afortunadamente, cada vez más investigadores se interesan en saber cómo se dio esa expansión, qué cambios tuvo el español en los distintos contextos americanos, cómo se dieron los diversos procesos de trasplante, qué resultados tuvieron, cuánto influyeron otras lenguas en la constitución de las variedades del español en América.</p>
                  <p class="section-sub">Desafortunadamente, solo podemos saber cómo sucedieron esos procesos a través de la escritura, por la obvia razón de que desde hace solo unas pocas generaciones es posible registrar la voz humana. Por lo tanto, el acercamiento a la historia lingüística en general, y, por tanto, a la historia lingüística de Uruguay tiene esa limitación.</p>
                  <p class="section-sub">El conjunto de documentos que aquí presentamos permiten, entonces, con las restricciones expresadas, una aproximación al período del siglo XIX de la lengua española en la zona del actual Uruguay.</p>
                  <p class="section-sub">Desde la década del 90, se viene desarrollando en el Instituto de Lingüística de la Facultad de Humanidades y Ciencias de la Educación (Universidad de la República, Montevideo) una línea de trabajo cuyo objetivo central es el estudio de la historia del español en el Uruguay. Esta tuvo como impulso inicial la propuesta de la <I>Comisión para el estudio del español de América</I> de la Asociación de Lingüística y Filología de América Latina (ALFAL), que auspició la creación de un proyecto coordinado entre diferentes países para el estudio de la historia del español en América1. Resultado de estos esfuerzos coordinados son las compilaciones de documentación americana de Fontanella de Weinberg (1993), Rojas (2000, 2001 y 2008)...</p>'];
    	$data[] = ['title' => 'Documentos portugués siglo XIX', 'body' => '<h2 class="section-title text-uppercase section-sub">Prólogo</h2>
                  <p class="section-sub">Todo aquello que existe hoy, en este momento, no fue siempre así. En el supuesto caso de que esa existencia actual pueda relacionarse con una anterior, diferente, la tarea del investigador no solo será la de observar cómo se llega del estadio anterior al actual, sino, en primer lugar, identificar ambas “existencias” como estadios diferentes de una sola entidad. Esta tarea es retrospectiva; la anterior, prospectiva.</p>
                  <p class="section-sub">A grandes rasgos, es ésta la tarea del historiador; si del historiador de la lengua se trata, el problema consiste en identificar y analizar, en los contextos lingüísticos y socioculturales pertinentes, las formas lingüísticas y las funciones que estas cumplen a lo largo del período en estudio.</p>
                  <p class="section-sub">Por otro lado, la afirmación que sigue parece de Perogrullo: para reconstruir el (un) pasado (y, en consecuencia, identificar lo actual como evolución y eventual culminación del/de un pasado) es necesario trabajar sobre materiales que actúen como testigos de aquellas épocas pasadas; en otras palabras, trabajar sobre “documentos”.</p>
                  <p class="section-sub">Obviamente, tales “documentos” no están disponibles como tales: es necesario ir en su búsqueda, muchas veces navegando casi a oscuras y sin un destino final cierto; pero, y así sucede en la gran mayoría de los casos, de improviso aparece una lucecita, una punta de una madeja de la que, si empezamos a tirar (también sabiendo cómo), puede provocar una inusitada y sorprendente iluminación que empieza a clarificar ese pasado. He aquí, entonces, que Fulano de Tal o Mengano de Cual, que el Acontecimiento tal o el Episodio cual se nos hacen más cercanos, nos invaden, se transforman en nuestros coetáneos, nos hablan de igual a igual. Cuando tal cosa sucede, ya no podremos liberarnos de ellos...</p>'];
    	return $data;
    }
    public function load(ObjectManager $manager)
    {
    	foreach($this->allData() as $data){
    		$trabajo = new Documento();
    		$trabajo->setTitle($data['title']);
    		$trabajo->setBody($data['body']);
    		$manager->persist($trabajo);
    	}
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}