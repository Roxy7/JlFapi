<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 * @ApiResource(
 *     collectionOperations={
 *     "get"={"method"="GET"},
 *      "post"={"method"="POST","access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *      "get"={"method"="GET"},
 *     "put"={"method"="PUT","access_control"="is_granted('ROLE_ADMIN')"},
 *     "delete"={"method"="DELETE","access_control"="is_granted('ROLE_ADMIN')"}
 *     }
 *     )
 * 
 */
class News
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string the news title
     * 
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $title='';

    /**
     * @var string the news title
     * 
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $content='';

    /**
     * @var array an array of string for a list
     * 
     * @ORM\Column(type="json_array")
     */
    private $list;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="news_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime the date when the object was created
     * 
     * @ORM\Column(type="datetime", nullable=False)
     */
    private $createdAt;

    /**
     * @var \DateTime the date when the object was updated/created
     * 
     * @ORM\Column(type="datetime", nullable=True)
     */
    private $updatedAt;
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title=$title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content=$content;
    }

    public function setList($list)
    {
        $this->list = json_encode($list);

        return $this;
    }

    public function getList()
    {
        return json_decode($this->list);
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return News
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return News
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
    *
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

}
