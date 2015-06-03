<?php

namespace Virgo\Tutorial\Entity;

/** @MappedSuperclass */
class AbstractEntity
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @Column(type="datetime", nullable=false)
     * @var \DateTime
     */
    protected $createdDate;

    /**
     * @Column(type="datetime", nullable=false)
     * @var \DateTime
     */
    protected $modifiedDate;

    /**
     * @Column(type="string", nullable=false)
     * @var string
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
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param \DateTime $modifiedDate
     */
    public function setModifiedDate(\DateTime $modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;
    }
}
