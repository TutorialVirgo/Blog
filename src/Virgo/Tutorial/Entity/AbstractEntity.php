<?php

namespace Virgo\Tutorial\Entity;

class AbstractEntity
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $createdDate;

    /**
     * @var \DateTime
     */

    protected $modifiedDate;

    /**
     * @var string
     */
    protected $status;



    public function __construct(){
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