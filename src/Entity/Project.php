<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $isActive;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private ?string $slug;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Language::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $language;

    public function __construct()
    {
        $this->language = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = trim($description);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setIsActive(string $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsActive(): ?string
    {
        return $this->isActive;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    public function setLanguage(?Language $language): self
    {
        $this->language = $language;

        return $this;
    }
}
