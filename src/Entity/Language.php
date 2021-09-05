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
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="language")
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
            $project->setLanguage($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getLanguage() === $this) {
                $project->setLanguage(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return 'Language';
    }

    public function setPhotoFilename($fileName): void
    {
        $this->icon = $fileName;
    }
}
