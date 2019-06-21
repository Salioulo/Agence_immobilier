<?php
namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


class PropertySearch{

    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minSurface;
    
    // ajour dans la recherche l'element option 
    /**
     * @var ArrayCollection
     */

     private $options;

     public function __construct()
    {
        $this->options = new ArrayCollection();
    }


   /**
    * @return int|null
    */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }
    
    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(?int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    
    /**
     * @param int|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(?int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $Options): void
    {
        $this->Options = $Options;
    }

}