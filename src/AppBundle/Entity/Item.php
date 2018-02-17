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
     * @ORM\Column(name="item_id", type="string", length=255, unique=true)
     */
    private $itemId;

    /**
     * @ORM\Column(name="endTime", type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @ORM\Column(name="gallery_url", type="string", length=255)
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
     * @ORM\Column(name="primary_category_id", type="integer")
     */
    private $primaryCategoryId;

    /**
     * @ORM\Column(name="primary_category_name", type="string", length=255)
     */
    private $primaryCategoryName;

    /**
     * @ORM\Column(name="bid_count", type="integer")
     */
    private $bidCount;

    /**
     * @ORM\Column(name="listing_status", type="string")
     */
    private $listingStatus;

    /**
     * @ORM\Column(name="time_left", type="string")
     */
    private $timeLeft;

    /**
     * @ORM\Column(name="auto_pay", type="boolean")
     */
    private $autoPay;

    /**
     * @ORM\Column(name="condition_name", type="string", length=10)
     */
    private $conditionName;

    /**
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
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
     * Set primaryCategoryId
     *
     * @param integer $primaryCategoryId
     *
     * @return Item
     */
    public function setPrimaryCategoryId($primaryCategoryId)
    {
        $this->primaryCategoryId = $primaryCategoryId;

        return $this;
    }

    /**
     * Get primaryCategoryId
     *
     * @return integer
     */
    public function getPrimaryCategoryId()
    {
        return $this->primaryCategoryId;
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
     * Set bidCount
     *
     * @param integer $bidCount
     *
     * @return Item
     */
    public function setBidCount($bidCount)
    {
        $this->bidCount = $bidCount;

        return $this;
    }

    /**
     * Get bidCount
     *
     * @return integer
     */
    public function getBidCount()
    {
        return $this->bidCount;
    }

    /**
     * Set listingStatus
     *
     * @param integer $listingStatus
     *
     * @return Item
     */
    public function setListingStatus($listingStatus)
    {
        $this->listingStatus = $listingStatus;

        return $this;
    }

    /**
     * Get listingStatus
     *
     * @return integer
     */
    public function getListingStatus()
    {
        return $this->listingStatus;
    }

    /**
     * Set timeLeft
     *
     * @param integer $timeLeft
     *
     * @return Item
     */
    public function setTimeLeft($timeLeft)
    {
        $this->timeLeft = $timeLeft;

        return $this;
    }

    /**
     * Get timeLeft
     *
     * @return integer
     */
    public function getTimeLeft()
    {
        return $this->timeLeft;
    }

    /**
     * Set autoPay
     *
     * @param boolean $autoPay
     *
     * @return Item
     */
    public function setAutoPay($autoPay)
    {
        $this->autoPay = $autoPay;

        return $this;
    }

    /**
     * Get autoPay
     *
     * @return boolean
     */
    public function getAutoPay()
    {
        return $this->autoPay;
    }

    /**
     * Set conditionName
     *
     * @param string $conditionName
     *
     * @return Item
     */
    public function setConditionName($conditionName)
    {
        $this->conditionName = $conditionName;

        return $this;
    }

    /**
     * Get conditionName
     *
     * @return string
     */
    public function getConditionName()
    {
        return $this->conditionName;
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
