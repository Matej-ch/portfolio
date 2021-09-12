<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("slug")
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="project:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="project:item"}}},
 *     order={"createdAt"="DESC" , "state"="ASC"},
 *     paginationEnabled=true
 * )
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['project:list', 'project:item'])]
    private int $id;

    /**
     * Name of the project
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    #[Groups(['project:list', 'project:item'])]
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['project:list', 'project:item'])]
    private int $isActive;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    #[Groups(['project:list', 'project:item'])]
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    #[Groups(['project:list', 'project:item'])]
    private string $slug;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    #[Groups(['project:list', 'project:item'])]
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Language::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['project:list', 'project:item'])]
    private $language;

    /**
     * @ORM\Column(type="string", length=255, options={"default": "wip"})
     */
    #[Groups(['project:list', 'project:item'])]
    private $state;

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

    public function computeSlug(SluggerInterface $slugger)
    {
        if (!$this->slug || '-' === $this->slug) {
            $this->slug = (string)$slugger->slug((string)$this)->lower();
        }
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

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime();

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

    public function __toString(): string
    {
        return 'Project';
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
