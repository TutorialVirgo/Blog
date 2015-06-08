<?php

namespace Virgo\Tutorial\Repository;

use Doctrine\ORM\EntityRepository;
use Virgo\Tutorial\Entity\Post;

class PostRepository extends EntityRepository
{
    /**
     * @param $userId
     * @return Post[]
     */
    public function findByUser($userId)
    {
        return $this->findBy(['user_id' => $userId]);
    }

    /**
     * @return Post[]
     */
    public function findAllPosts()
    {
        return $this->findAll();
    }
}
