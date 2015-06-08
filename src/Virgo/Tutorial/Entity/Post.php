<?php

namespace Virgo\Tutorial\Entity;

/**
 * @Table(name="post")
 * @Entity(repositoryClass="Virgo\Tutorial\Repository\PostRepository")
 **/
class Post extends AbstractEntity
{
    /**
     * @Column(type="integer" ,nullable=false)
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var string
     */
    protected $user_id;

    /**
     * @Column(type="string", length=255, nullable=false)
     * @var string
     */
    protected $title;

    /**
     * @Column(type="string", length=256 ,nullable=false )
     * @var string
     */
    protected $email;

    /**
     * @Column(type="text", nullable=false)
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}
