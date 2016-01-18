<?php

namespace Admin\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PostTags
 *
 * @ORM\Table(name="post_tags", indexes={@ORM\Index(name="PostTag_tag", columns={"tag_id"}), @ORM\Index(name="PostTag_post", columns={"post_id"})})
 * @ORM\Entity
 */
class PostTags
{
    /**
     * @var integer
     *
     * @ORM\Column(name="post_tags_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postTagsId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=true)
     */
    private $userId;

    /**
     * @var \Post
     *
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;

    /**
     * @var \Tags
     *
     * @ORM\ManyToOne(targetEntity="Tags")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     * })
     */
    private $tag;



    /**
     * Get postTagsId
     *
     * @return integer
     */
    public function getPostTagsId()
    {
        return $this->postTagsId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return PostTags
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set post
     *
     * @param \Admin\BlogBundle\Entity\Post $post
     *
     * @return PostTags
     */
    public function setPost(\Admin\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Admin\BlogBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set tag
     *
     * @param \Admin\BlogBundle\Entity\Tags $tag
     *
     * @return PostTags
     */
    public function setTag(\Admin\BlogBundle\Entity\Tags $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Admin\BlogBundle\Entity\Tags
     */
    public function getTag()
    {
        return $this->tag;
    }
}
