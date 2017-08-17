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
class LoadOtrasCategoriasFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function getOrder()
    {
        return 7;
    }

    private function allDataIndigena()
    {
        $data = [];
        $data[] = ['author' => 'Breviario de etnología y arqueología del Uruguay.', 'year' => 2012, 'description' => 'José Joaquín Figueira. Tomado del “Boletín histórico del Estado Mayor General del Ejército”, Nº 104, 105, página 29-68 (en <a href="http://www.ejercito.mil.uy" target="blank">http://www.ejercito.mil.uy</a>). Montevideo, 1965.'];
        $data[] = ['author' => 'Las lenguas indígenas del Uruguay.', 'year' => 2012, 'description' => 'Juan Carlos Sabat Pebet y José Joaquín Figueira.  Tomado del “Boletín histórico del Estado Mayor General del Ejército”, Nº 120, 123, página 188-220 (en <a href="http://www.ejercito.mil.uy" target="blank">http://www.ejercito.mil.uy</a>). Montevideo, 1969.'];
        $data[] = ['author' => 'Los indios chanases y su lengua.', 'year' => 2012, 'description' => 'Lafone Quevedo, Samuel A. “Boletín del Instituto Geográfico Argentino”, tomo XVIII, 1897, Buenos Aires, La Buenos Aires (115-154).'];
        $data[] = ['author' => 'Nuevos elementos acerca de la lengua charrúa.', 'year' => 2012, 'description' => 'J.P Rona. Facultad de Humanidades y Ciencias. Departamento de Lingüística. Montevideo, 1964. Páginas. 7-28.'];
        $data[] = ['author' => 'Transcripción tipografica y exégesis filológica provisional del Códice Vilardebó.', 'year' => 2012, 'description' => 'S. Perea y Alonso. “Boletín de Filología”, tomo II, números 6-7, 1938, Instituto de Estudios Superiores (7-18).'];
        $data[] = ['author' => 'Un vocabulario charrúa desconocido.', 'year' => 2012, 'description' => 'Juan Carlos Gómez Haedo. “Boletín de Filología”, tomo I, números 4-5, 1937, Instituto de Estudios Superiores (323-350).'];

        return $data;
    }

    private function allDataAfricana()
    {
        $data = [];
        $data[] = ['author' => 'Comparsa Pobres Negros Orientales, 1876. Tango. Título: “Mis Caprichos”.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa. Establecimiento tipográfico á vapor La Idea, Montevideo, Año VI, Nº 6, páginas 32-33. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Pobres Negros Orientales, 1876. Tango: sin título.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa. Establecimiento tipográfico á vapor La Idea, Montevideo, Año VI, Nº 6, 1876, páginas 33-35. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Negros Lubolos, 1877. Despedida.', 'year' => 2012, 'description' => 'Tomado en El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Año VII, Nº 7, 1877, páginas 13-14. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Negros Lubolos, 1877. Tango. Título: “Las Modas”.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de canciones de la mayor parte de comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, 1877, Año VII, Nº 7, 1877, páginas 12-13. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Negros Lubolos, 1877. Tango: sin título.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Año VII, Nº 7, 1877, páginas 9-10. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Pobres Negros Orientales, 1877. Tango: sin título.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Aó VII, Nº 7, 1877, páginas 35-36. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Negros Lubolos, 1878. Tango. Título: “El mitelio etá tapao”.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Año VIII, Nº 8, 1878, páginas 6-7. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Negros Lubolos, 1878. Tango: sin título.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Año VIII, Nº 8, 1878, páginas 3-6. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Raza Africana, 1877. Tango. Título: “La Atropellada”.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Año VII, Nº 7, 1877, páginas 8-9. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Raza Africana, 1876. Tango: sin título.', 'year' => 2012, 'description' => 'Tomado de El Carnaval. Colección de Canciones de la mayor parte de las comparsas carnavalescas por Figaro o sea Julio Figueroa, Establecimiento tipográfico á vapor La Idea, Montevideo, Año VI, Nº 6, 1876, páginas 30-31. Material conservado en la Sala Uruguay en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'Comparsa Sociedad Nación Bayombé, 1884. Título: “Cuchicheo”.', 'year' => 2012, 'description' => 'El Carnaval de 1884. Periódico crítico, burlesco y de avisos. Montevideo, domingo 24 de febrero de 1884. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Citado en Goldman (2008c: 213).'];
        $data[] = ['author' => 'Comparsa Sociedad Nación Bayombé, 1884. Letra de M. Padín y música del maestro Striggelli.', 'year' => 2012, 'description' => 'El Carnaval de 1884. Periódico crítico, burlesco y de avisos. Montevideo, domingo 24 de febrero de 1884. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Citado en Goldman (2008c: 52).'];
        $data[] = ['author' => 'El Constitucional.', 'year' => 2012, 'description' => 'Sin título, Montevideo, 15 de diciembre de 1842. Nº 1150. Sección Correspondencia. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Citado en Montaño (2008: 454).'];
        $data[] = ['author' => 'El Ferrocarril.', 'year' => 2012, 'description' => 'Comparsa Pobres Negros Orientales. Martes 1º y miércoles 2 de marzo de 1870. P 1, Año II, Nº 309. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Citado en Goldman (2008c: 169).'];
        $data[] = ['author' => 'El Ferrocarril.', 'year' => 2012, 'description' => 'Sábado 12 febrero de 1870. Mensaje de un lector afrodescendiente con motivo del cumpleaños de Isidoro de María. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Citado en Goldman (2008c: 157).'];
        $data[] = ['author' => 'El Gaucho Oriental.', 'year' => 2012, 'description' => 'Montevideo, 09 de setiembre de 1839, página 2. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Tomado de www.periodicas.edu.uy.'];
        $data[] = ['author' => 'El Indicador. “Quindongo candituyose”.', 'year' => 2012, 'description' => 'Jueves 13 de octubre de 1831, Nº 98, página 3, columnas 2ª y 3ª. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Citado en Montaño (2008: 452).'];
        $data[] = ['author' => 'El Progresista.', 'year' => 2012, 'description' => 'Montevideo, setiembre-octubre, 1872. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'El Siglo. “Elocuencia manguinga”.', 'year' => 2012, 'description' => 'Montevideo, 08 de enero de 1870, columna 3ª. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Mala calidad de imagen.'];
        $data[] = ['author' => 'El Tambor de la Línea. “Batuque”, Montevideo, 1843.', 'year' => 2012, 'description' => 'Material conservado en la Biblioteca Nacional (Montevideo, Uruguay). Publicado en Ayestarán (1953: 71).'];
        $data[] = ['author' => 'El Universal. “Canto patriótico de los negros. Celebrando á la ley de vientres y á la Constitución”.', 'year' => 2012, 'description' => 'Montevideo, 27 de noviembre de 1834, columnas 2ª y 3ª. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'La Atalaya de Ulises.', 'year' => 2012, 'description' => 'Transcripciones de Ciertas cantinelas escuchadas en los candombes montevideanos. Impresora y Editora Renacimiento. Montevideo, 1922. Citado en Carvalho Neto (1965: 304-5).'];
        $data[] = ['author' => 'La Conservación, Montevideo, 1872.', 'year' => 2012, 'description' => 'Material conservado en la Biblioteca Nacional (Montevideo, Uruguay).'];
        $data[] = ['author' => 'La Opinión Nacional. “Discurso”.', 'year' => 2012, 'description' => 'Miércoles 10 de enero de 1886, Montevideo, Año I, Nº 20, columna 3ª. Material conservado en la Biblioteca Nacional (Montevideo, Uruguay).'];

        return $data;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->allDataIndigena() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-lenguas-indigenas'));
            $manager->persist($trabajo);
        }

        foreach ($this->allDataAfricana() as $data) {
            $trabajo = new Trabajo();
            $trabajo->setAuthors($data['author']);
            $trabajo->setDescription($data['description']);
            $trabajo->setCategory($this->getReference('category-lenguas-africanas'));
            $manager->persist($trabajo);
        }
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
