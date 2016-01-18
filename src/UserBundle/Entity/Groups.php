<?php

namespace UserBundle\Entity;
use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserBundle\Entity\GroupsRepository")
 */
class Groups extends BaseGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}

