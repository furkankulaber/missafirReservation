<?php

namespace App\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait EntityTrait
{

    /**
     * @var DateTime
     * @ORM\Column(name="dateCreated", type="datetime", nullable=false)
     */
    private DateTime $dateCreated;

    /**
     * @var DateTime|null
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    private ?DateTime $dateUpdated;

    /**
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @ORM\PrePersist
     * @return $this
     */
    public function setDateCreated($datetime)
    {
        $this->dateCreated = $datetime ?? new DateTime('now');
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @ORM\PreUpdate
     * @return $this
     */
    public function setDateUpdated($datetime)
    {
        $this->dateUpdated = $datetime ?? new DateTime('now');;
        return $this;
    }
}