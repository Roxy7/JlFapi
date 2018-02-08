<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
/**
 *
 * @ApiResource
 * @ORM\Entity
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
    
    
    public function getId(): int
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

    public function getList($list) 
    {
        return json_decode($this->list);
    }

}
