<?php

namespace Virgo\Tutorial\Entity;

use Doctrine\ORM\Mapping as ORM;

class AbstractEntity
{
    /**
     * @var integer
     * @ORM\Column(type="integer", unique="true")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $modifiedDate;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    protected $status;

    public function __construct()
    {
        $this->createdDate = new \Datetime;
        $this->modifiedDate = new \Datetime;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param \DateTime $modifiedDate
     */
    public function setModifiedDate(\DateTime $modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
