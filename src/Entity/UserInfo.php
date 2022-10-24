<?php

namespace App\Entity;

use App\Repository\UserInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PostLoad;

#[ORM\Entity(repositoryClass: UserInfoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class UserInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isActive = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $data = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $avatar = null;

    public ?array $decodedData = null;

    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'userInfos')]
    private Collection $service;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private ?string $avatarBig = null;

    #[ORM\Column(type: 'string', length: 2048, nullable: true)]
    private ?string $whoAmI = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $aboutMeTitle = null;

    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    #[PostLoad]
    public function setDecodedData(): void
    {
        $this->decodedData = json_decode($this->getData(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function getUserData()
    {
        return $this->decodedData;
    }

    public function getName(): string
    {
        return $this->decodedData['name'] ?? '';
    }

    public function getWorkEmail(): string
    {
        return $this->decodedData['work_email'] ?? '';
    }

    public function getLocation(): string
    {
        return $this->decodedData['location'] ?? '';
    }

    public function getEducation(): string
    {
        return $this->decodedData['education'] ?? '';
    }

    public function getWork(): string
    {
        return $this->decodedData['work'] ?? '';
    }

    public function getDescription(): string
    {
        return $this->decodedData['description'] ?? '';
    }

    public function getGithubName(): string
    {
        return $this->decodedData['github_name'] ?? '';
    }

    public function setName(?string $name): self
    {
        $this->decodedData['name'] = $name;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setWorkEmail(?string $email): self
    {
        $this->decodedData['work_email'] = $email;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setLocation(?string $location): self
    {
        $this->decodedData['location'] = $location;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setEducation(?string $education): self
    {
        $this->decodedData['education'] = $education;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setWork(?string $work): self
    {
        $this->decodedData['work'] = $work;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setDescription(?string $desc): self
    {
        $this->decodedData['description'] = $desc;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setGithubName(?string $githubName): self
    {
        $this->decodedData['github_name'] = $githubName;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Service $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service[] = $service;
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        $this->service->removeElement($service);

        return $this;
    }

    public function getAvatarBig(): ?string
    {
        return $this->avatarBig;
    }

    public function setAvatarBig(?string $avatarBig): self
    {
        $this->avatarBig = $avatarBig;

        return $this;
    }

    public function getWhoAmI(): ?string
    {
        return $this->whoAmI;
    }

    public function setWhoAmI(?string $whoAmI): self
    {
        $this->whoAmI = $whoAmI;

        return $this;
    }

    public function getAboutMeTitle(): ?string
    {
        return $this->aboutMeTitle;
    }

    public function setAboutMeTitle(string $aboutMeTitle): self
    {
        $this->aboutMeTitle = $aboutMeTitle;

        return $this;
    }

    public function getFiverrEnable(): ?bool
    {
        return $this->decodedData['fiverr']['enable'] ?? false;
    }

    public function getFiverrHtml(): ?string
    {
        return $this->decodedData['fiverr']['html'] ?? '';
    }

    public function getFiverrId(): ?string
    {
        return $this->decodedData['fiverr']['id'] ?? '';
    }

    public function getFiverrSrc(): ?string
    {
        return $this->decodedData['fiverr']['src'] ?? '';
    }

    public function setFiverrEnable(bool $enable): self
    {
        $this->decodedData['fiverr']['enable'] = $enable;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setFiverrHtml(string $html): self
    {
        $this->decodedData['fiverr']['html'] = $html;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setFiverrId(string $id): self
    {
        $this->decodedData['fiverr']['id'] = $id;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }

    public function setFiverrSrc(string $src): self
    {
        $this->decodedData['fiverr']['src'] = $src;

        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);

        return $this;
    }
}
