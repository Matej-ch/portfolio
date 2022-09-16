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
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity("slug")]
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

    #[ORM\Column(type: 'datetime', nullable: false)]
    #[Groups(['project:list', 'project:item'])]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $updatedAt;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'projects')]
    private $tags;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $sourceUrl;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $projectUrl;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'projects')]
    private $language;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bgImg;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $shortDescription;

    #[ORM\ManyToOne(targetEntity: ProjectState::class, inversedBy: 'projects')]
    private $projectState;

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
        return 'Project';
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
}
