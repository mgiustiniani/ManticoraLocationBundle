<?php
namespace Manticora\LocationBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

use JMS\Serializer\Annotation as Serializer;

use Hateoas\Configuration\Annotation as Hateoas;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "get_zone",
 *          parameters = {
 *              "zone" = "expr(object.getId())",
 *              "_format" = "json"
 *          },
 *          absolute = true
 *
 *      ),
 *
 *      exclusion = @Hateoas\Exclusion(groups = {"list", "detail", "profile"})
 * )
 * @Gedmo\Tree(type="nested")
 * 
 * @ORM\Entity(repositoryClass="Manticora\LocationBundle\Repository\ZoneRepository")
 */
class Zone
{
    /** 
     * @ORM\Id
     * @Serializer\Groups({"list","detail"})
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Serializer\Groups({"list","detail"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lft;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rgt;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lvl;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(type="integer", nullable=true)
     */
    private $root;

    /**
     * @Serializer\Groups({"list","detail"})
     * @ORM\Column(type="string", nullable=true)
     */
    private $type;

    /** 
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $originalId;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Manticora\LocationBundle\Entity\Zone", inversedBy="children")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Manticora\LocationBundle\Entity\Zone", mappedBy="parent")
     * @ORM\OrderBy({"lft"="ASC"})
     */
    private $children;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Zone
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Zone
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    
        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Zone
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    
        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Zone
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    
        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Zone
     */
    public function setRoot($root)
    {
        $this->root = $root;
    
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Zone
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set originalId
     *
     * @param string $originalId
     * @return Zone
     */
    public function setOriginalId($originalId)
    {
        $this->originalId = $originalId;
    
        return $this;
    }

    /**
     * Get originalId
     *
     * @return string 
     */
    public function getOriginalId()
    {
        return $this->originalId;
    }

    /**
     * Set parent
     *
     * @param \Manticora\LocationBundle\Entity\Zone $parent
     * @return Zone
     */
    public function setParent(\Manticora\LocationBundle\Entity\Zone $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Manticora\LocationBundle\Entity\Zone 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Manticora\LocationBundle\Entity\Zone $children
     * @return Zone
     */
    public function addChildren(\Manticora\LocationBundle\Entity\Zone $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Manticora\LocationBundle\Entity\Zone $children
     */
    public function removeChildren(\Manticora\LocationBundle\Entity\Zone $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }
}