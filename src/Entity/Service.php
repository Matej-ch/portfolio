<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $title;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: UserInfo::class, inversedBy: 'services')]
    private $userInfo;

    public function __construct()
    {
        $this->userInfo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|UserInfo[]
     */
    public function getUserInfo(): Collection
    {
        return $this->userInfo;
    }

    public function addUserInfo(UserInfo $userInfo): self
    {
        if (!$this->userInfo->contains($userInfo)) {
            $this->userInfo[] = $userInfo;
        }

        return $this;
    }

    public function removeUserInfo(UserInfo $userInfo): self
    {
        $this->userInfo->removeElement($userInfo);

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }


}
