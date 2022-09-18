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

    #[ORM\ManyToMany(targetEntity: UserInfo::class, mappedBy: 'service')]
    private $userInfos;

    public function __construct()
    {
        $this->userInfos = new ArrayCollection();
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
    public function getUserInfos(): Collection
    {
        return $this->userInfos;
    }

    public function addUserInfo(UserInfo $userInfo): self
    {
        if (!$this->userInfos->contains($userInfo)) {
            $this->userInfos[] = $userInfo;
        }

        return $this;
    }

    public function removeUserInfo(UserInfo $userInfo): self
    {
        if ($this->userInfos->removeElement($userInfo)) {
            $userInfo->removeService($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }


}
