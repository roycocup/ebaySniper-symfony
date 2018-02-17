<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bid
 *
 * @ORM\Table(name="bid")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BidRepository")
 */
class Bid
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Item", mappedBy="bid")
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\Column(name="timeBeforeClose", type="integer")
     */
    private $timeBeforeClose;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set timeBeforeClose
     *
     * @param integer $timeBeforeClose
     *
     * @return Bid
     */
    public function setTimeBeforeClose($timeBeforeClose)
    {
        $this->timeBeforeClose = $timeBeforeClose;

        return $this;
    }

    /**
     * Get timeBeforeClose
     *
     * @return integer
     */
    public function getTimeBeforeClose()
    {
        return $this->timeBeforeClose;
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return Bid
     */
    public function addItem(\AppBundle\Entity\Item $item)
    {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Item $item
     */
    public function removeItem(\AppBundle\Entity\Item $item)
    {
        $this->item->removeElement($item);
    }

    /**
     * Get item
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItem()
    {
        return $this->item;
    }
}
