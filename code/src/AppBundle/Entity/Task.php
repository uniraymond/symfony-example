<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class Task
 * @package AppBundle\Entity
 * @author Raymond F. <raymond@studionone.com.au>
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", type="smallint", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $tag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $finishAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $updatedById;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $commont;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    public function __construct()
    {
        $this->startAt = new \DateTime();
        $this->finishAt = new \DateTime();
    }


    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    }

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
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Task
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set startAt
     *
     * @param \DateTime $startAt
     * @return Task
     */
    public function setStartAt($startAt)
    {
        if (!$this->getStartAt()) {
            $this->startAt = new \DateTime();
        }

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime 
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set finishAt
     *
     * @param string $finishAt
     * @return Task
     */
    public function setFinishAt($finishAt)
    {
        if (!$this->getFinishAt()) {
            $this->finishAt = new \DateTime();
        }

        return $this;
    }

    /**
     * Get finishAt
     *
     * @return string 
     */
    public function getFinishAt()
    {
        return $this->finishAt;
    }

    /**
     * Set contnet
     *
     * @param string $contnet
     * @return Task
     */
    public function setContnet($contnet)
    {
        $this->contnet = $contnet;

        return $this;
    }

    /**
     * Get contnet
     *
     * @return string 
     */
    public function getContnet()
    {
        return $this->contnet;
    }

    /**
     * Set commont
     *
     * @param string $commont
     * @return Task
     */
    public function setCommont($commont)
    {
        $this->commont = $commont;

        return $this;
    }

    /**
     * Get commont
     *
     * @return string 
     */
    public function getCommont()
    {
        return $this->commont;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Task
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Task
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Task
     */
    public function setUpdatedAt($updatedAt)
    {
        if (!$this->getUpdatedAt()) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedById
     *
     * @param integer $updatedById
     * @return Task
     */
    public function setUpdatedById($updatedById)
    {
        $this->updatedById = $updatedById;

        return $this;
    }

    /**
     * Get updatedById
     *
     * @return integer 
     */
    public function getUpdatedById()
    {
        return $this->updatedById;
    }
}
