<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="blog_post")
 */
class BlogPost implements \JsonSerializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="title")
     */
    protected $title;

    /**
     * @ORM\Column(type="string", name="body")
     */
    protected $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="accurate_at", type="datetime")
     * @Assert\DateTime()
     * @Assert\LessThanOrEqual("now")
     */
    protected $accurateAt;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return BlogPost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return BlogPost
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAccurateAt()
    {
        return $this->accurateAt;
    }

    /**
     * @param \DateTime $accurateAt
     * @return BlogPost
     */
    public function setAccurateAt(\DateTime $accurateAt)
    {
        $this->accurateAt = $accurateAt;

        return $this;
    }

    /**
     * @return mixed
     */
    function jsonSerialize()
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'body'  => $this->body,
        ];
    }

}