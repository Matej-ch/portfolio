<?php

namespace App\Entity;


use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity("slug")]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 1])]
    private int $isActive = 1;

    #[ORM\Column(type: 'string', length: 1024, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $updatedAt;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'projects')]
    private Collection $tags;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private ?string $sourceUrl = null;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private ?string $projectUrl = null;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'projects')]
    private ?Collection $language;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $bgImg = null;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\ManyToOne(targetEntity: ProjectState::class, inversedBy: 'projects')]
    private ?ProjectState $projectState;

    #[ORM\Column(nullable: true)]
    private ?bool $readmeIsEnabled = false;

    #[ORM\Column(nullable: true)]
    private int $ordering = 0;

    #[ORM\ManyToMany(targetEntity: ProjectCollection::class, mappedBy: 'project')]
    private ?Collection $collections;

    #[ORM\Column(options: ['default' => false])]
    private bool $isLanding = false;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->language = new ArrayCollection();
        $this->collections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
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

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getSourceUrl(): ?string
    {
        return $this->sourceUrl;
    }

    public function setSourceUrl(?string $sourceUrl): self
    {
        $this->sourceUrl = $sourceUrl;

        return $this;
    }

    public function getProjectUrl(): ?string
    {
        return $this->projectUrl;
    }

    public function setProjectUrl(?string $projectUrl): self
    {
        $this->projectUrl = $projectUrl;

        return $this;
    }

    /**
     * @return Collection
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
     * @return Collection
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
        return $this->bgImg;
    }

    public function setBgImg(?string $bgImg): self
    {
        $this->bgImg = $bgImg;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    #[PrePersist]
    public function setTimestamps(LifecycleEventArgs $eventArgs)
    {
        $this->createdAt = new \DateTime(date('Y-m-d H:i:s'));
        $this->updatedAt = new \DateTime(date('Y-m-d H:i:s'));
    }

    #[PreUpdate]
    public function updateTimestamps(PreUpdateEventArgs $eventArgs)
    {
        $this->updatedAt = new \DateTime(date('Y-m-d H:i:s'));
    }

    public function getProjectState(): ?ProjectState
    {
        return $this->projectState;
    }

    public function setProjectState(?ProjectState $projectState): self
    {
        $this->projectState = $projectState;

        return $this;
    }

    public function isReadmeIsEnabled(): ?bool
    {
        return $this->readmeIsEnabled;
    }

    public function setReadmeIsEnabled(?bool $readmeIsEnabled): self
    {
        $this->readmeIsEnabled = $readmeIsEnabled;

        return $this;
    }

    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    public function setOrdering(?int $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * @return Collection<int, ProjectCollection>
     */
    public function getCollections(): Collection
    {
        return $this->collections;
    }

    public function addCollection(ProjectCollection $collection): self
    {
        if (!$this->collections->contains($collection)) {
            $this->collections->add($collection);
            $collection->addProject($this);
        }

        return $this;
    }

    public function removeCollection(ProjectCollection $collection): self
    {
        if ($this->collections->removeElement($collection)) {
            $collection->removeProject($this);
        }

        return $this;
    }

    public function isIsLanding(): ?bool
    {
        return $this->isLanding;
    }

    public function setIsLanding(bool $isLanding): self
    {
        $this->isLanding = $isLanding;

        return $this;
    }
}
