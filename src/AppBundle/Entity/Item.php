<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */
class Item
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
     * @var string
     *
     * @ORM\Column(name="ItemId", type="string", length=255, unique=true)
     */
    private $itemId;

    /**
     * @ORM\Column(name="endTime", type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\Column(name="galleryURL", type="string", length=255)
     */
    private $galleryURL;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(name="primaryCategoryName", type="string", length=255)
     */
    private $primaryCategoryName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;



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
     * Set itemId
     *
     * @param string $itemId
     *
     * @return Item
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Item
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set galleryURL
     *
     * @param string $galleryURL
     *
     * @return Item
     */
    public function setGalleryURL($galleryURL)
    {
        $this->galleryURL = $galleryURL;

        return $this;
    }

    /**
     * Get galleryURL
     *
     * @return string
     */
    public function getGalleryURL()
    {
        return $this->galleryURL;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Item
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set primaryCategoryName
     *
     * @param string $primaryCategoryName
     *
     * @return Item
     */
    public function setPrimaryCategoryName($primaryCategoryName)
    {
        $this->primaryCategoryName = $primaryCategoryName;

        return $this;
    }

    /**
     * Get primaryCategoryName
     *
     * @return string
     */
    public function getPrimaryCategoryName()
    {
        return $this->primaryCategoryName;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Item
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Item
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
