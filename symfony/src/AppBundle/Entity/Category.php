<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category.
 *
 * @ORM\Table(name="lenguas_category")
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 */
class Category
{
    const PUBLICACION = 1;
    const MONOGRAFIA = 2;
    const FUENTES = 3;
    const OTROS = 4;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="longname", type="string", length=255, nullable=true)
     */
    private $longname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", unique=true)
     */
    protected $slug;

    /**
     * @var int
     *
     * @Gedmo\SortablePosition
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var int
     * @Gedmo\SortableGroup
     * @ORM\Column(name="type", type="smallint")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Trabajo", mappedBy="category")
     */
    private $trabajos;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set orden.
     *
     * @param int $orden
     *
     * @return Category
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden.
     *
     * @return int
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return Category
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->trabajos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add trabajo.
     *
     * @param \AppBundle\Entity\Trabajo $trabajo
     *
     * @return Category
     */
    public function addTrabajo(\AppBundle\Entity\Trabajo $trabajo)
    {
        $this->trabajos[] = $trabajo;

        return $this;
    }

    /**
     * Remove trabajo.
     *
     * @param \AppBundle\Entity\Trabajo $trabajo
     */
    public function removeTrabajo(\AppBundle\Entity\Trabajo $trabajo)
    {
        $this->trabajos->removeElement($trabajo);
    }

    /**
     * Get trabajos.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrabajos()
    {
        return $this->trabajos;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set longname.
     *
     * @param string $longname
     *
     * @return Category
     */
    public function setLongname($longname)
    {
        $this->longname = $longname;

        return $this;
    }

    /**
     * Get longname.
     *
     * @return string
     */
    public function getLongname()
    {
        return $this->longname;
    }

    public function getMenuName()
    {
        if ($this->getType() == self::PUBLICACION) {
            return 'publicaciones';
        }
        if ($this->getType() == self::MONOGRAFIA) {
            return 'monografias';
        }
        if ($this->getType() == self::FUENTES) {
            return 'fuentes';
        }
        if ($this->getType() == self::OTROS) {
            return 'otros';
        }

        return $this->getType();
    }

    public function getMenuShowYears()
    {
        if ($this->getType() == self::PUBLICACION) {
            return true;
        }
        if ($this->getType() == self::MONOGRAFIA) {
            return false;
        }
        if ($this->getType() == self::FUENTES) {
            return false;
        }
        if ($this->getType() == self::OTROS) {
            return false;
        }

        return false;
    }

    public function getMenuData()
    {
        return [
                'activemenu' => $this->getMenuName(),
                'activesubmenu' => $this->getName(),
                'header' => $this->getMenuName(),
                'showYear' => $this->getMenuShowYears(),
          ];
    }

    public static function getNameOfType($type)
    {
        $type = (int) $type;
        if ($type == self::PUBLICACION) {
            return 'publicaciones';
        }
        if ($type == self::MONOGRAFIA) {
            return 'monografias';
        }
        if ($type == self::FUENTES) {
            return 'fuentes';
        }
        if ($type == self::OTROS) {
            return 'otros';
        }

        return $type;
    }
}
