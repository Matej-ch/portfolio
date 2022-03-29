<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity("slug")]
#[ApiResource(
    collectionOperations: ["get" => ['normalization_context' => ['groups' => 'project:list']]],
    itemOperations: ["get" => ['normalization_context' => ['groups' => 'project:item']]],
    order: ["createdAt" => "DESC", "state" => "ASC"],
    paginationEnabled: true)]
#[ApiFilter(SearchFilter::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['project:list', 'project:item'])]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[NotBlank]
    #[Groups(['project:list', 'project:item'])]
    private string $name;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 1])]
    #[Groups(['project:list', 'project:item'])]
    private int $isActive = 1;

    #[ORM\Column(type: 'string', length: 1024, nullable: true)]
    #[Groups(['project:list', 'project:item'])]
    private ?string $description;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Groups(['project:list', 'project:item'])]
    private string $slug;


    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['project:list', 'project:item'])]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255, options: ['default' => 'wip'])]
    #[Groups(['project:list', 'project:item'])]
    private $state;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'projects')]
    private $tags;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $source_url;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $project_url;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'projects')]
    private $language;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bg_img;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $short_description;

    #[ORM\OneToOne(targetEntity: ProjectState::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(name: 'state', nullable: false)]
    private $fullState;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsActive(): ?bool
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

    public function getSourceUrl(): ?string
    {
        return $this->source_url;
    }

    public function setSourceUrl(?string $source_url): self
    {
        $this->source_url = $source_url;

        return $this;
    }

    public function getProjectUrl(): ?string
    {
        return $this->project_url;
    }

    public function setProjectUrl(?string $project_url): self
    {
        $this->project_url = $project_url;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addProject($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeProject($this);
        }

        return $this;
    }

    /**
     * @return Collection|Language[]
     */
    public function getLanguage(): Collection
    {
        return $this->language;
    }

    public function addLanguage(Language $language): self
    {
        if (!$this->language->contains($language)) {
            $this->language[] = $language;
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        $this->language->removeElement($language);

        return $this;
    }

    public function getBgImg(): ?string
    {
        return $this->bg_img;
    }

    public function setBgImg(?string $bg_img): self
    {
        $this->bg_img = $bg_img;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getFullState(): ?ProjectState
    {
        return $this->fullState;
    }

    public function setFullState(ProjectState $fullState): self
    {
        $this->fullState = $fullState;

        return $this;
    }
}
