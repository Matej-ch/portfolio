<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="json", length=512, nullable=true)
     */
    private $versions;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=512, nullable=false)
     *
     */
    #[Assert\NotBlank]
    private $type;

    /**
     * @ORM\Column(type="boolean", options={"default": "0"})
     */
    private $hide = false;

    /**
     * @ORM\ManyToMany(targetEntity=Project::class, mappedBy="language")
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getVersions(): ?string
    {
        return $this->versions;
    }

    public function setVersions(?string $versions): self
    {
        $this->versions = $versions;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIconPath(): string
    {
        return 'uploads/languages/'.$this->icon;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function setPhotoFilename($fileName): self
    {
        $this->icon = $fileName;

        return $this;
    }

    public function getHide(): ?bool
    {
        return $this->hide;
    }

    public function setHide(bool $hide): self
    {
        $this->hide = $hide;

        return $this;
    }

    public function getVersionsArray(): array
    {
        return explode(',',$this->versions);
    }

    public function setVersionsArray($versionsArray): self
    {
        $this->versions = implode(',',$versionsArray);

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addLanguage($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeLanguage($this);
        }

        return $this;
    }
}
